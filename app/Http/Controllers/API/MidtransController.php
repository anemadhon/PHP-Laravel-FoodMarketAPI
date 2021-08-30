<?php

namespace App\Http\Controllers\API;

use App\Helpers\MidtransConfiguration;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Midtrans\Notification;

class MidtransController extends Controller
{
    public function callback()
    {
        MidtransConfiguration::index();

        $notification = self::_getNotification();

        self::_handleNotification($notification);
    }

    private static function _getNotification()
    {
        $notification = new Notification();

        $data['status'] = $notification->transaction_status;

        $data['type'] = $notification->payment_type;

        $data['fraud'] = $notification->fraud_status;
        
        $data['order_id'] = $notification->order_id;

        return $data;
    }

    private static function _handleNotification(array $notification)
    {
        $transaction = Transaction::findOrFail($notification['order_id']);

        if ($notification['status'] == 'capture' && $notification['type'] == 'credit_card' && $notification['fraud'] == 'challenge')
        {
            $transaction->status = 'PENDING';

            $transaction->save();
        }
        
        if ($notification['status'] == 'capture' && $notification['type'] == 'credit_card' && $notification['fraud'] != 'challenge')
        {
            $transaction->status = 'SUCCESS';

            $transaction->save();
        }

        if ($notification['status'] == 'settlement')
        {
            $transaction->status = 'SUCCESS';

            $transaction->save();
        }
        
        if ($notification['status'] == 'pending')
        {
            $transaction->status = 'PENDING';

            $transaction->save();
        }
        
        if ($notification['status'] == 'deny' || $notification['status'] == 'expire' || $notification['status'] == 'cancel')
        {
            $transaction->status = 'CANCEL';

            $transaction->save();
        }
    }
}
