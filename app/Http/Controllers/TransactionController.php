<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Session;


class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        $currentUser = Auth::user();
        $transactions = Transaction::all();

                foreach($transactions as $transaction) {
                    if ($transaction->username === $currentUser->name) {
                        echo 'TRANSACTIONS:';
                        echo 'TYPE: '.$transaction->type_of_transaction;
                        echo 'CURRENT BALANCE: '.$transaction->balance;
                        echo 'TIME OF OPERATION: '.$transaction->time_of_transaction;
                    } else {
                        'Transactions for this user was not found.';
                    }
                }

        return view('transactions');
    }

    public function buy(Request $value)
    {
        $currentUser = Auth::user();

        $users = User::all();
        foreach($users as $user) {
            if ($currentUser->name === $user->name) {
                $user->balance = $user->balance+$value->buy;
                $user->save();
                Session::put('balance', $user->balance);
            }
        }

        $transaction = new Transaction;
        $transaction->type_of_transaction = 'buy';
        $transaction->username = $currentUser->name;
        $transaction->balance = Session::get('balance');
        $transaction->time_of_transaction = now();
        $transaction->save();

        return view('buyOrSold');
    }

    public function sale(Request $value)
    {
        $currentUser = Auth::user();

        $users = User::all();
        foreach($users as $user) {
            if ($currentUser->name === $user->name) {
                $user->balance = $user->balance-$value->buy;
                $user->save();
                Session::put('balance', $user->balance);
            }
        }

        $transaction = new Transaction;
        $transaction->type_of_transaction = 'sale';
        $transaction->username = $currentUser->name;
        $transaction->balance = Session::get('balance');
        $transaction->time_of_transaction = now();
        $transaction->save();

        return view('buyOrSold');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
