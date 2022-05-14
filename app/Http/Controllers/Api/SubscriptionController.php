<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SuccessResource;
use App\Models\User;
use App\Rules\SubscriptionExistsRule;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function subscribe(Request $request) {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'website_id' => ['required', 'exists:websites,id', new SubscriptionExistsRule($request->input('website_id'), $request->input('user_id'))],
        ]);

        User::find($request->input('user_id'))->websites()->attach($request->input('website_id'));
    
        return new SuccessResource('Success', []);
    }

    
    public function unsubscribe(Request $request) {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'website_id' => 'required|exists:websites,id',
        ]);

        User::find($request->input('user_id'))->websites()->detach($request->input('website_id'));
    
        return new SuccessResource('Success', []);
    }
}