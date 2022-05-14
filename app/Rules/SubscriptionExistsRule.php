<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class SubscriptionExistsRule implements Rule
{
    public $website_id;
    public $user_id;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($website_id, $user_id)
    {
        $this->website_id = $website_id;
        $this->user_id = $user_id;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return DB::table('user_website')->where('user_id', $this->user_id)->where('website_id', $this->website_id)->count() === 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'User is already subscribed to this website';
    }
}
