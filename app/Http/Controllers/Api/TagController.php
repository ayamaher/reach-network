<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all()->toArray();
        return response()->json(['data' => $tags, 'status' => 200]);

    }

    public function store(Request $request)
    {
        $tag = Tag::create($request->all());
        return response()->json(['data' => $tag, 'status' => 201]);
    }

    public function update($id, Request $request)
    {
        $tag = Tag::find($id);
        $tag->update($request->all());
        return response()->json(['data' => $tag, 'status' => 200]);
    }

    public function delete($id)
    {
        $tag = Tag::findOrFail($id);
        $response['is_deleted'] = $tag->destroy($id);
        $response['message'] = 'tag has been deleted';
        return response()->json($response);
    }
}
