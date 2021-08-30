<?php

namespace App\Http\Controllers\API;

use Exception;
use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Helpers\MidtransConfiguration;
use App\Http\Requests\TransactionRequest;

class TransactionController extends Controller
{
    public function all(Request $request)
    {
        $id = $request->input('id');

        $limit = $request->input('limit', 6);

        $foodId = $request->input('food_id');

        $status = $request->input('status');

        if ($id)
        {
            $transaction = Transaction::with(['food', 'user'])->find($id);

            if (!$transaction) return ResponseFormatter::error(null, 'Transaction Not Found', 404);

            return ResponseFormatter::success($transaction, 'Transaction Founded');
        }

        $transaction = Transaction::with(['food', 'user'])->where('user_id', Auth::user()->id);

        if ($foodId) $transaction->where('food_id', $foodId);
        if ($status) $transaction->where('status', $status);

        return ResponseFormatter::success($transaction->paginate($limit), 'Transaction Founded');
    }

    public function checkout(TransactionRequest $request)
    {
        $data = $request->validated();

        $data['payment_url'] = '';

        $transaction = Transaction::create($data);

        MidtransConfiguration::index();

        $currentTransaction = self::_getCurrentTransaction($transaction);

        $midtrans = self::_createMidtransBody($currentTransaction);

        try 
        {
            self::_updatePaymentURL($currentTransaction, $midtrans);
        } 
        catch (Exception $error)
        {
            self::_deleteCurrentTransaction($transaction);

            return ResponseFormatter::error($error, 'Transaction Failed', 500);
        }
    }

    private static function _getCurrentTransaction(object $transaction)
    {
        return Transaction::with(['food', 'user'])->find($transaction->id);
    }

    private static function _createMidtransBody(object $currentTransaction)
    {
        return array(
            'transaction_details' => array(
                'order_id' => $currentTransaction->id,
                'gross_amount' => (int) $currentTransaction->total
            ),
            'customer_details' => array(
                'first_name' => $currentTransaction->user->name,
                'email' => $currentTransaction->user->email,
            ),
            'enabled_payment' => array('gopay', 'bank_transfer'),
            'vtweb' => array()

        );
    }

    private static function _updatePaymentURL(object $currentTransaction, array $midtrans)
    {
        $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;

        $currentTransaction->payment_url = $paymentUrl;

        $currentTransaction->save();

        return ResponseFormatter::success($currentTransaction, 'Transaction Successed'); 
    }

    private static function _deleteCurrentTransaction(object $transaction)
    {
        self::_cancelStatusTransaction($transaction);

        $transaction->delete();
    }

    private static function _cancelStatusTransaction(object $transaction)
    {
        $transaction->status = 'Cancelled';
        $transaction->update();
    }
}
