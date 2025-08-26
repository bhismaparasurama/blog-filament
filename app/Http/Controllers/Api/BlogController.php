<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Http\Resources\BlogResource;

class BlogController extends Controller
{
    public function index()
    {
        return BlogResource::collection(
            Blog::with('category')->latest()->get()
        );
    }

    public function show($id)
    {
        $blog = Blog::with('category')->findOrFail($id);
        return new BlogResource($blog);
    }
}
