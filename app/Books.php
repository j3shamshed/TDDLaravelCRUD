<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    protected $guarded = [];

    public function path()
    {
        return '/books/' . $this->id;
    }
}
