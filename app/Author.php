<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $guarded = [];
    protected $dates = ['dob'];

    public function setDobAttribute($dob)
    {
        $dob = Carbon::createFromFormat('d/m/Y', $dob);
        $this->attributes['dob'] = Carbon::parse($dob);
    }
}
