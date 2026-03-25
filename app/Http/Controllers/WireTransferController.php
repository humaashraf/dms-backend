<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WireTransfer;
use App\Models\BankAccount;
use App\Models\GeneralSetting;

class WireTransferController extends Controller
{

public function index()
{
    $transfers = WireTransfer::with('bankAccount')->get();
    $dateFormat = GeneralSetting::first()->datetime_format ?? 'Y-m-d H:i:s';

    return response()->json([
        'status' => true,
        'message' => 'Wire transfers fetched successfully',
        'data' => [
            'transfers' => $transfers,
            'dateFormat' => $dateFormat
        ]
    ]);
}


public function create()
{
    $bankAccounts = BankAccount::where('status', 0)
        ->orderByDesc('id')
        ->get()
        ->unique('account_number')
        ->values();

    return response()->json([
        'status' => true,
        'message' => 'Bank accounts fetched successfully',
        'data' => [
            'bankAccounts' => $bankAccounts
        ]
    ]);
}



    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'amount' => 'required|numeric|min:1',
            'status' => 'required',
            'date' => 'required|date',
            'bank_account_id' => 'required|exists:bank_accounts,id',
        ]);

        $selectedAccount = BankAccount::findOrFail($request->bank_account_id);
        $latestBank = BankAccount::where('account_number', $selectedAccount->account_number)
            ->orderByDesc('id')
            ->first();

        $newBalance = $latestBank->balance - $request->amount;
        if ($newBalance < 0) {
            return response()->json([
                'status' => false,
                'message' => 'Insufficient bank balance.'
            ], 400);
        }

        $transfer = WireTransfer::create([
            'name' => $request->name,
            'amount' => $request->amount,
            'status' => $request->status,
            'date' => $request->date,
            'bank_account_id' => $request->bank_account_id,
            'remaining_amount' => $request->amount,
        ]);

        BankAccount::create([
            'account_title' => $latestBank->account_title,
            'account_number' => $latestBank->account_number,
            'bank_name' => $latestBank->bank_name,
            'balance' => $newBalance,
            'status' => $latestBank->status,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Wire transfer recorded successfully!',
            'data' => $transfer
        ], 201);
    }


    // public function edit($id)
    // {
    //     $transfer = WireTransfer::find($id);
    //     if (!$transfer) {
    //         return response()->json(['status' => false, 'message' => 'Transfer not found'], 404);
    //     }

    //     $bankAccounts = BankAccount::where('status', 0)
    //         ->orderByDesc('id')
    //         ->get()
    //         ->unique('account_number')
    //         ->values();

    //     return response()->json([
    //         'status' => true,
    //         'message' => 'Transfer data fetched successfully',
    //         'data' => [
    //             'transfer' => $transfer,
    //             'bankAccounts' => $bankAccounts
    //         ]
    //     ]);
    // }

    public function edit($id)
{
    $transfer = WireTransfer::with('bankAccount')->find($id); // Load related bank account
    if (!$transfer) {
        return response()->json([
            'status' => false,
            'message' => 'Transfer not found'
        ], 404);
    }

    $bankAccounts = BankAccount::where('status', 0)
        ->orderByDesc('id')
        ->get()
        ->unique('account_number')
        ->values();

    return response()->json([
        'status' => true,
        'message' => 'Transfer data fetched successfully',
        'data' => [
            'transfer' => $transfer,
            'bankAccounts' => $bankAccounts
        ]
    ]);
}



   public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required',
        'amount' => 'required|numeric|min:1',
        'status' => 'required',
        'date' => 'required|date',
        'bank_account_id' => 'exists:bank_accounts,id',
    ]);

    $transfer = WireTransfer::findOrFail($id);

    if ($request->bank_account_id != $transfer->bank_account_id) {
        return response()->json([
            'status' => false,
            'message' => 'You cannot change the bank account during update.'
        ], 400);
    }

    $oldAmount = $transfer->amount;
    $selectedAccount = BankAccount::findOrFail($request->bank_account_id);
    $latestBank = BankAccount::where('account_number', $selectedAccount->account_number)
        ->orderByDesc('id')
        ->first();

    $newBalance = $latestBank->balance + $oldAmount - $request->amount;

    if ($newBalance < 0) {
        return response()->json([
            'status' => false,
            'message' => 'Insufficient bank balance after adjustment.'
        ], 400);
    }

    // ✅ Calculate remaining amount correctly
    $spent = $oldAmount - $transfer->remaining_amount; // amount already used
    $newRemaining = $request->amount - $spent;
    if ($newRemaining < 0) {
        $newRemaining = 0; // prevent negative
    }

    $transfer->update([
        'name' => $request->name,
        'amount' => $request->amount,
        'status' => $request->status,
        'date' => $request->date,
        'bank_account_id' => $request->bank_account_id,
        'remaining_amount' => $newRemaining,
    ]);

    BankAccount::create([
        'account_title' => $latestBank->account_title,
        'account_number' => $latestBank->account_number,
        'bank_name' => $latestBank->bank_name,
        'balance' => $newBalance,
        'status' => $latestBank->status,
    ]);

    return response()->json([
        'status' => true,
        'message' => 'Wire transfer updated successfully!',
        'data' => $transfer
    ]);
}



public function show($id)
{
    $transfer = WireTransfer::with('bankAccount')->find($id); // Eager load relationship
    if (!$transfer) {
        return response()->json(['status' => false, 'message' => 'Transfer not found'], 404);
    }

    return response()->json([
        'status' => true,
        'message' => 'Transfer details fetched successfully',
        'data' => $transfer
    ]);
}



    public function destroy($id)
    {
        $transfer = WireTransfer::find($id);
        if (!$transfer) {
            return response()->json(['status' => false, 'message' => 'Transfer not found'], 404);
        }

        $selectedAccount = BankAccount::findOrFail($transfer->bank_account_id);
        $latestBank = BankAccount::where('account_number', $selectedAccount->account_number)
            ->orderByDesc('id')
            ->first();

        $newBalance = $latestBank->balance + $transfer->amount;

        BankAccount::create([
            'account_title' => $latestBank->account_title,
            'account_number' => $latestBank->account_number,
            'bank_name' => $latestBank->bank_name,
            'balance' => $newBalance,
            'status' => $latestBank->status,
        ]);

        $transfer->delete();

        return response()->json([
            'status' => true,
            'message' => 'Wire transfer deleted and bank balance updated!'
        ]);
    }
}
