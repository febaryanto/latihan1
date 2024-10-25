<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\BankAccount;
use Illuminate\Http\Request;

class BankAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($userId)
    {
        $userData = User::with(['bankAccounts'])->where('id', $userId)->first();
        return view('bank-account.index', compact('userData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($userId)
    {
        $userData = User::where('id', $userId)->first();
        return view('bank-account.create', compact('userData'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $userId)
    {
        $request->validate([
            'bank_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:255',
            'status' => 'required|string'
        ]);

        $bankAccount = new BankAccount();
        $bankAccount->bank_name = $request->bank_name;
        $bankAccount->account_number = $request->account_number;
        $bankAccount->user_id = $userId;
        $bankAccount->status = $request->status;
        $bankAccount->save();

        return redirect()->route('user.bank-account.index', $userId)->with('success', 'Data rekening berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(BankAccount $bankAccount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($userId, $id)
    {
        $bankAccount = BankAccount::with('user')->where('id', $id)->first();
        return view('bank-account.edit', compact('bankAccount'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $userId, $id)
    {
        $request->validate([
            'bank_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:255',
            'status' => 'required|string'
        ]);
        $bankAccount = BankAccount::findOrFail($id);

        // Update the bank account fields with validated data
        $bankAccount->bank_name = $request->input('bank_name');
        $bankAccount->account_number = $request->input('account_number');
        $bankAccount->status = $request->input('status');

        // Save changes to the database
        $bankAccount->save();
        return redirect()->route('user.bank-account.index', [$userId, $id])->with('success', 'Data rekening berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($userId, $id)
    {
        $bankAccount = BankAccount::findOrFail($id);
        $bankAccount->delete();

        return redirect()->route('user.bank-account.index', [$userId, $id])->with('success', 'Data rekening berhasil dihapus');
    }
}
