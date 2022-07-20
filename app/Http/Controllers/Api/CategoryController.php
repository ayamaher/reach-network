<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all()->toArray();
        return response()->json(['data' => $categories, 'status' => 200]);

    }

    public function store(Request $request)
    {
        $category = Category::create($request->all());
        return response()->json(['data' => $category, 'status' => 201]);
    }

    public function update($id, Request $request)
    {
        $category = Category::find($id);
        $category->update($request->all());
        return response()->json(['data' => $category, 'status' => 200]);
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);
        $response['is_deleted'] = $category->destroy($id);
        $response['message'] = 'category has been deleted';
        return response()->json($response);
    }
}
