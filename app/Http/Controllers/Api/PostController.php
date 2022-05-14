<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SuccessResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function getPosts()
    {
        return new SuccessResource('Success', Post::all());
    }

    public function storePosts(Request $request)
    {
        $request->validate([
            'website_id' => 'required|exists:websites,id',
            'title' => 'required',
            'text' => 'required'
        ]);
        
        return new SuccessResource('Success', Post::create($request->all()));
    }

    public function getPost(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
        ]);

        return new SuccessResource('Success', Post::find($request->input('post_id')));
    }

    public function updatePosts(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'website_id' => 'required|exists:websites,id',
            'title' => 'required',
            'text' => 'required'
        ]);

        $post = Post::find($request->input('post_id'));
        $post->update($request);

        return new SuccessResource('Success', Post::find($request->input('post_id')));
    }

    public function deletePosts(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
        ]);

        return new SuccessResource('Success', Post::destroy($request->input('post_id')));
    }
}
