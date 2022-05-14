<?php

namespace App\Observers;

use App\Models\Post;
use App\Models\User;
use App\Notifications\PostCreateNotification;
use Illuminate\Support\Facades\DB;

class PostObserver
{
    /**
     * Handle the Post "created" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function created(Post $post)
    {
        $website = $post->website;
        $website_users = DB::table('user_website')->where('website_id', $website->id)->get()->pluck('user_id')->toArray();
        $users = User::whereIn('id', $website_users)->get();
        foreach($users as $user) {
            $user->notify(new PostCreateNotification($post));
        }
    }
}
