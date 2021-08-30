<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::query()->with(['food', 'user']);

        $transactions->when(request('search') ?? false, fn($query, $key) =>
            $query->where(fn() => 
                $query->where('status', 'like', '%'.$key.'%')
                    ->orwhereHas('user', fn($query) => 
                        $query->where('name', 'like', '%'.$key.'%')
                    )
                    ->orwhereHas('food', fn($query) => 
                        $query->where('name', 'like', '%'.$key.'%')
                    )
            )
        );

        return view('transactions.index',[
            'transactions' => $transactions->paginate(5)->withQueryString()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    /* public function show(Transaction $transaction)
    {
        return view('transactions.show', [
            'transaction' => $transaction
        ]);
    } */
    public function show(Transaction $transaction)
    {
        return view('transactions.show', [
            'transaction' => $transaction
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return redirect()->route('transactions.index');
    }

    public function changeStatus(int $id, string $status)
    {
        $transaction = Transaction::findOrFail($id);

        $transaction->status = $status;

        $transaction->save();

        return redirect()->route('transactions.show', $id);
    }
}
