<?php

namespace App\UrlShortener\Models;

use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    protected $fillable = ['url', 'short_path', 'visits'];
}
