<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SuccessResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function getPosts() {

    }

    public function storePosts(Request $request) {
        $request->validate([
            'website_id' => 'required|exists:websites,id',
            'title' => 'required|max:255',
            'text' => 'required',
        ]);

        Post::create($request);

        return new SuccessResource();
    }

    public function getPost() {
        
    }

    public function updatePosts() {
        
    }

    public function deletePosts() {
        
    }

}
