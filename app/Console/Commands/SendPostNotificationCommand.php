<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Models\User;
use App\Notifications\PostCreateNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SendPostNotificationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:postnotify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send the email to the website subscribers';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    { $posts = Post::with(['website'])->get();
        $users = User::with('websites')->get();
        foreach($posts as $post)
        {
            foreach($users as $user)
            {
                if($this->hasUserSubscribedToThisPostWebsite($post, $user))
                {
                    $is_user_notified = DB::table('notify_user')->where('user_id', $user->id)->where('post_id', $post->id)->get()->count();
                    if(!$is_user_notified)
                    {
                        $user->notify(new PostCreateNotification($post));
                    }
                }
            }
        }
    }

    private function hasUserSubscribedToThisPostWebsite($post, $user)
    {
        $user_websites_ids = [];
        foreach($user->websites as $website)
        {
            $user_websites_ids[] = $website->id;
        }

        if(in_array($post->website->id, $user_websites_ids))
        {
            return true;
        }

        return false;
    }
}
