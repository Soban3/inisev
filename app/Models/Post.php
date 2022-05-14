<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['website_id', 'title', 'text'];

    use HasFactory;

    public function website() {
        return $this->belongsTo(Website::class);
    }
}
