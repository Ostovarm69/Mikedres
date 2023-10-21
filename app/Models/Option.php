<?php

namespace App\Models;

use App\Traits\Languageable;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use Languageable;

    protected $guarded = ['id'];
    public $timestamps = false;
}
