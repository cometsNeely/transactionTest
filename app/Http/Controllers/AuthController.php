<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;

class AuthController extends Controller
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
        return view('auth.create');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function authorization()
    {
        return view('auth.auth');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->balance = 100.0;
        $user->save();

        Session::put('balance', $user->balance);

        auth()->login($user);

        return redirect()->to('/transaction');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
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

    public function login(Request $request)
    {
        $users = User::all();

        foreach($users as $user) {
            if ($request->name === $user->name && Hash::check($request->password, $user->password)) {
                auth()->login($user);
                Session::put('balance', $user->balance);
                return redirect()->to('/transaction');
            } else
            {
               echo 'This user was not found.'; break;
            }
        }
    }

    public static function logout()
    {
        auth()->logout();

        return redirect()->to('/auth');
    }
}
