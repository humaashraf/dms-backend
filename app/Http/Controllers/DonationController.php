<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donation;
use App\Models\DonationCategory;
use App\Models\BankAccount;
use App\Models\PaymentMethod;
use App\Models\GeneralSetting;

class DonationController extends Controller
{

    public function index()
{
    $donations = Donation::with(['paymentMethod', 'category', 'bankAccount']) // Relationships load
        ->orderBy('id', 'desc')
        ->get();

    $dateFormat = GeneralSetting::first()->datetime_format;

    return response()->json([
        'status' => true,
        'message' => 'Donations fetched successfully',
        'data' => [
            'donations' => $donations,
            'dateFormat' => $dateFormat
        ]
    ], 200);
}


    public function create()
    {
        $categories = DonationCategory::where('status', 0)->get();
        // $bankAccounts = BankAccount::where('status', 0)->orderByDesc('id')->get()->unique('account_number');
            $bankAccounts = BankAccount::where('status', 0)
        ->orderByDesc('id')
        ->get()
        ->unique('account_number')
        ->values();
        $paymentMethods = PaymentMethod::all();

        return response()->json([
            'status' => true,
            'message' => 'Form data fetched successfully',
            'data' => [
                'categories' => $categories,
                'bankAccounts' => $bankAccounts,
                'paymentMethods' => $paymentMethods
            ]
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:donations,email',
            'phone' => 'required',
            'city' => 'required',
            'address' => 'required',
            'amount' => 'required|numeric|min:1',
            'date' => 'required',
            'donation_category_id' => 'required|exists:donation_categories,id',
            'bank_account_id' => 'required|exists:bank_accounts,id',
            'payment_method_id' => 'required|exists:payment_methods,id',
        ]);

        $donation = Donation::create($request->all());

        $existing = BankAccount::findOrFail($request->bank_account_id);
        $newBalance = $existing->balance + $request->amount;

        BankAccount::create([
            'account_title' => $existing->account_title,
            'account_number' => $existing->account_number,
            'bank_name' => $existing->bank_name,
            'balance' => $newBalance,
            'status' => $existing->status,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Donation created and new bank account record added!',
            'data' => $donation
        ], 201);
    }

    public function edit($id)
    {
        $donation = Donation::findOrFail($id);
        $categories = DonationCategory::all();
        $bankAccounts = BankAccount::where('status', 0)->orderByDesc('id')->get()->unique('account_number');
        $paymentMethods = PaymentMethod::all();

        return response()->json([
            'status' => true,
            'message' => 'Donation edit data fetched successfully',
            'data' => [
                'donation' => $donation,
                'categories' => $categories,
                'bankAccounts' => $bankAccounts,
                'paymentMethods' => $paymentMethods
            ]
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'city' => 'required',
            'address' => 'required',
            'amount' => 'required|numeric|min:1',
            'date' => 'required',
            'donation_category_id' => 'required|exists:donation_categories,id',
            'bank_account_id' => 'required|exists:bank_accounts,id',
            'payment_method_id' => 'required|exists:payment_methods,id',
        ]);

        $donation = Donation::findOrFail($id);
        $oldAmount = $donation->amount;

        $donation->update($request->all());

        $newAmount = $request->amount;
        $difference = $newAmount - $oldAmount;

        $selectedBank = BankAccount::findOrFail($request->bank_account_id);
        $latestBank = BankAccount::where('account_number', $selectedBank->account_number)->orderByDesc('id')->first();

        $newBalance = $latestBank->balance + $difference;

        if ($newBalance < 0) {
            return response()->json([
                'status' => false,
                'message' => 'Insufficient bank balance after adjustment.'
            ], 400);
        }

        BankAccount::create([
            'account_title' => $latestBank->account_title,
            'account_number' => $latestBank->account_number,
            'bank_name' => $latestBank->bank_name,
            'balance' => $newBalance,
            'status' => $latestBank->status,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Donation updated and bank balance adjusted!',
            'data' => $donation
        ], 200);
    }

    public function destroy($id)
    {
        $donation = Donation::findOrFail($id);
        $oldBank = BankAccount::find($donation->bank_account_id);

        if ($oldBank) {
            $latestBank = BankAccount::where('account_number', $oldBank->account_number)->orderByDesc('id')->first();
            $newBalance = $latestBank->balance - $donation->amount;

            if ($newBalance < 0) {
                return response()->json([
                    'status' => false,
                    'message' => 'Insufficient balance after deletion.'
                ], 400);
            }

            BankAccount::create([
                'account_title' => $latestBank->account_title,
                'account_number' => $latestBank->account_number,
                'bank_name' => $latestBank->bank_name,
                'balance' => $newBalance,
                'status' => $latestBank->status,
            ]);
        }

        $donation->delete();

        return response()->json([
            'status' => true,
            'message' => 'Donation deleted and bank balance updated!'
        ], 200);
    }

public function show($id)
{
    $donation = Donation::with(['category', 'bankAccount', 'paymentMethod'])->findOrFail($id);

    return response()->json([
        'status' => true,
        'message' => 'Donation details retrieved successfully.',
        'data' => [
            'id' => $donation->id,
            'first_name' => $donation->first_name,
            'last_name' => $donation->last_name,
            'email' => $donation->email,
            'phone' => $donation->phone,
            'city' => $donation->city,
            'address' => $donation->address,
            'amount' => $donation->amount,
            'date' => $donation->date ? $donation->date->format('d-m-Y') : null,
            'payment_method' => $donation->paymentMethod ? $donation->paymentMethod->name : null,
            'donation_category' => $donation->category ? $donation->category->name : null,
            'bank_account' => $donation->bankAccount
                ? [
                    'account_title' => $donation->bankAccount->account_title,
                    'account_number' => $donation->bankAccount->account_number,
                    'masked_account_number' => '****' . substr($donation->bankAccount->account_number, -4)
                ]
                : null
        ]
    ], 200);
}




}
