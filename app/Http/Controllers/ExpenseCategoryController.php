<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExpenseCategory;
use App\Models\Expenses;

class ExpenseCategoryController extends Controller
{
    // GET /api/expense-categories
    public function index()
    {
        $categories = ExpenseCategory::all();
        return response()->json($categories);
    }

    // POST /api/expense-categories
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required|boolean',
        ]);

        $category = ExpenseCategory::create($request->all());

        return response()->json([
            'message' => 'Expense category created successfully!',
            'data' => $category
        ], 201);
    }

    // GET /api/expense-categories/{id}
    public function show($id)
    {
        $category = ExpenseCategory::find($id);

        if (!$category) {
            return response()->json(['message' => 'Expense category not found'], 404);
        }

        return response()->json($category);
    }

    // PUT /api/expense-categories/{id}
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required|boolean',
        ]);

        $category = ExpenseCategory::find($id);

        if (!$category) {
            return response()->json(['message' => 'Expense category not found'], 404);
        }

        $category->update($request->all());

        return response()->json([
            'message' => 'Expense category updated successfully!',
            'data' => $category
        ]);
    }

    // DELETE /api/expense-categories/{id}
    public function destroy($id)
    {
        $category = ExpenseCategory::find($id);

        if (!$category) {
            return response()->json(['message' => 'Expense category not found'], 404);
        }

        // Check if this expense category is being used in the expenses table
        $isUsedInExpenses = Expenses::where('expense_category_id', $id)->exists();

        if ($isUsedInExpenses) {
            return response()->json([
                'message' => 'Cannot delete: This Expense Category is being used in Expenses.'
            ], 400);
        }

        $category->delete();

        return response()->json([
            'message' => 'Expense category deleted successfully!'
        ]);
    }
}
