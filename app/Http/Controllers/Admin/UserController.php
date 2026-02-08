<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::get();
        return view('admin.user.index', compact('users'));
    }
    public function addCoins(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount'  => 'required|integer|min:1',
        ]);

        $user = User::findOrFail($request->user_id);
        $user->coins += $request->amount;
        $user->save();


        // // Add coins
        // $coin = Coin::firstOrCreate(['user_id' => $user->id]);
        // $coin->balance += $request->amount;
        // $coin->save();

        // Log transaction
        // CoinTransaction::create([
        //     'user_id' => $user->id,
        //     'amount'  => $request->amount,
        //     'type'    => 'admin_add',
        //     'description' => 'Coins added by admin',
        // ]);

        return back()->with('success', 'Coins added successfully!');
    }
}
