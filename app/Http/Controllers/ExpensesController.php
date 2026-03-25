<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expenses;
use App\Models\ExpenseCategory;
use App\Models\WireTransfer;
use App\Models\GeneralSetting;

class ExpensesController extends Controller
{

    public function index()
    {
        $expenses = Expenses::with(['category', 'wireTransfer.bankAccount'])->get();
        $dateFormat = GeneralSetting::first()->datetime_format;
        return response()->json([
            'status' => true,
            'message' => 'Expenses fetched successfully',
            'data' => $expenses,
            'dateFormat' => $dateFormat
        ]);
    }


    public function create()
    {
        $categories = ExpenseCategory::all();
        $wireTransfers = WireTransfer::with('bankAccount')->get();

        return response()->json([
            'status' => true,
            'message' => 'Form data fetched successfully',
            'categories' => $categories,
            'wire_transfers' => $wireTransfers
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'date' => 'required|date',
            'details' => 'required|string',
            'receipt' => 'required|string',
            'expense_category_id' => 'required|exists:expense_categories,id',
            'wire_transfer_id' => 'nullable|exists:wire_transfers,id',
        ]);

        if ($request->wire_transfer_id) {
            $wireTransfer = WireTransfer::find($request->wire_transfer_id);
            if ($wireTransfer && $request->amount > $wireTransfer->remaining_amount) {
                return response()->json([
                    'status' => false,
                    'message' => 'Selected wire transfer does not have enough remaining amount.'
                ], 400);
            }
        }

        $expense = Expenses::create($request->all());

        if ($request->wire_transfer_id && isset($wireTransfer)) {
            $wireTransfer->remaining_amount -= $request->amount;
            $wireTransfer->save();
        }

        return response()->json([
            'status' => true,
            'message' => 'Expense created successfully',
            'data' => $expense
        ]);
    }


    public function show($id)
    {
        $expense = Expenses::with(['category', 'wireTransfer.bankAccount'])->find($id);
        if (!$expense) {
            return response()->json(['status' => false, 'message' => 'Expense not found'], 404);
        }
        $dateFormat = GeneralSetting::first()->datetime_format;

        return response()->json([
            'status' => true,
            'message' => 'Expense details fetched successfully',
            'data' => $expense,
            'dateFormat' => $dateFormat
        ]);
    }

public function edit($id)
{
    $expense = Expenses::find($id);

    if (!$expense) {
        return response()->json([
            'status' => false,
            'message' => 'Expense not found'
        ], 404);
    }

    $categories = ExpenseCategory::all();
    $wireTransfers = WireTransfer::with('bankAccount')->get();

    return response()->json([
        'status' => true,
        'message' => 'Expense data fetched successfully',
        'expense' => $expense,
        'categories' => $categories,
        'wire_transfers' => $wireTransfers
    ]);
}

    public function update(Request $request, $id)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'date' => 'required|date',
            'details' => 'required|string',
            'receipt' => 'required|string',
            'expense_category_id' => 'required|exists:expense_categories,id',
            'wire_transfer_id' => 'nullable|exists:wire_transfers,id',
        ]);

        $expense = Expenses::findOrFail($id);
        $oldAmount = $expense->amount;
        $oldWireTransferId = $expense->wire_transfer_id;
        $newWireTransferId = $request->wire_transfer_id;
        $newAmount = $request->amount;

        if ($oldWireTransferId != $newWireTransferId) {
            if ($oldWireTransferId) {
                $oldWireTransfer = WireTransfer::find($oldWireTransferId);
            }

            if ($newWireTransferId) {
                $newWireTransfer = WireTransfer::find($newWireTransferId);
                if ($newWireTransfer && $newWireTransfer->remaining_amount < $newAmount) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Selected wire transfer does not have enough remaining amount.'
                    ], 400);
                }
            }
        } elseif ($newWireTransferId) {
            $wireTransfer = WireTransfer::find($newWireTransferId);
            $difference = $newAmount - $oldAmount;
            if ($difference > 0 && $wireTransfer->remaining_amount < $difference) {
                return response()->json([
                    'status' => false,
                    'message' => 'Not enough remaining amount in the selected wire transfer.'
                ], 400);
            }
        }

        // Update remaining amounts
        if ($oldWireTransferId != $newWireTransferId) {
            if ($oldWireTransfer ?? false) {
                $oldWireTransfer->remaining_amount += $oldAmount;
                $oldWireTransfer->save();
            }
            if ($newWireTransfer ?? false) {
                $newWireTransfer->remaining_amount -= $newAmount;
                $newWireTransfer->save();
            }
        } elseif ($wireTransfer ?? false) {
            $wireTransfer->remaining_amount -= $difference;
            $wireTransfer->save();
        }

        $expense->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Expense updated successfully',
            'data' => $expense
        ]);
    }


    public function destroy($id)
    {
        $expense = Expenses::findOrFail($id);
        if ($expense->wire_transfer_id) {
            $wireTransfer = WireTransfer::find($expense->wire_transfer_id);
            if ($wireTransfer) {
                $wireTransfer->remaining_amount += $expense->amount;
                $wireTransfer->save();
            }
        }
        $expense->delete();

        return response()->json([
            'status' => true,
            'message' => 'Expense deleted successfully'
        ]);
    }
}
