<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BankAccount;
use App\Models\Donation;
use App\Models\WireTransfer;

class BankAccountController extends Controller
{
    public function index()
    {
        $bankAccounts = BankAccount::select('account_number', 'account_title', 'bank_name', \DB::raw('MAX(id) as latest_id'))
            ->groupBy('account_number', 'account_title', 'bank_name')
            ->get()
            ->map(function ($row) {
                return BankAccount::find($row->latest_id);
            });

        return response()->json([
            'status' => true,
            'data' => $bankAccounts,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'account_title' => 'required',
            'account_number' => 'required',
            'bank_name' => 'required',
            'balance' => 'required|numeric',
            'status' => 'required|boolean',
        ]);

        $account = BankAccount::create($validated);

        return response()->json([
            'status' => true,
            'message' => 'Account created successfully!',
            'data' => $account,
        ]);
    }

    public function show($id)
    {
        $account = BankAccount::find($id);

        if (!$account) {
            return response()->json(['status' => false, 'message' => 'Account not found'], 404);
        }

        return response()->json(['status' => true, 'data' => $account]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'account_title' => 'required',
            'account_number' => 'required',
            'bank_name' => 'required',
            'balance' => 'required|numeric',
            'status' => 'required|boolean',
        ]);

        $account = BankAccount::find($id);

        if (!$account) {
            return response()->json(['status' => false, 'message' => 'Account not found'], 404);
        }

        $account->update($validated);

        return response()->json([
            'status' => true,
            'message' => 'Account updated successfully!',
            'data' => $account,
        ]);
    }

    public function destroy($id)
    {
        $account = BankAccount::find($id);

        if (!$account) {
            return response()->json(['status' => false, 'message' => 'Account not found'], 404);
        }

        $usedInDonations = Donation::where('bank_account_id', $id)->exists();
        $usedInWireTransfers = WireTransfer::where('bank_account_id', $id)->exists();

        if ($usedInDonations && $usedInWireTransfers) {
            return response()->json([
                'status' => false,
                'message' => 'Cannot delete: This Bank Account is being used in both Donations and Wire Transfers.',
            ], 403);
        } elseif ($usedInDonations) {
            return response()->json([
                'status' => false,
                'message' => 'Cannot delete: This Bank Account is being used in Donations.',
            ], 403);
        } elseif ($usedInWireTransfers) {
            return response()->json([
                'status' => false,
                'message' => 'Cannot delete: This Bank Account is being used in Wire Transfers.',
            ], 403);
        }

        $account->delete();

        return response()->json([
            'status' => true,
            'message' => 'Account deleted successfully!',
        ]);
    }
}
