<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function getPosts() {

    }

    public function storePosts(Request $request) {
        $request->validate([
            ''
        ]);
    }

    public function getPost() {
        
    }

    public function updatePosts() {
        
    }

    public function deletePosts() {
        
    }

}
