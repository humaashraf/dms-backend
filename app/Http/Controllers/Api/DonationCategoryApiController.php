<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DonationCategory;
use App\Models\Donation;

class DonationCategoryApiController extends Controller
{
    public function index()
    {
        $categories = DonationCategory::all();
        return response()->json($categories);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'status' => 'required|boolean',
        ]);

        $category = DonationCategory::create($request->all());

        return response()->json([
            'message' => 'Donation category created successfully!',
            'data' => $category
        ], 201);
    }

    public function show($id)
    {
        $category = DonationCategory::find($id);

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        return response()->json($category);
    }

    public function update(Request $request, $id)
    {
        $category = DonationCategory::find($id);

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        $request->validate([
            'name' => 'required|string',
            'status' => 'required|boolean',
        ]);

        $category->update($request->all());

        return response()->json([
            'message' => 'Donation category updated successfully!',
            'data' => $category
        ]);
    }

    public function destroy($id)
    {
        $category = DonationCategory::find($id);

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        $isUsed = Donation::where('donation_category_id', $id)->exists();

        if ($isUsed) {
            return response()->json([
                'message' => 'Cannot delete: This category is used in Donations.'
            ], 400);
        }

        $category->delete();

        return response()->json([
            'message' => 'Donation category deleted successfully!'
        ]);
    }
}
