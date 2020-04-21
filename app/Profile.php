<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = [];

    public function profileLogo()
    {
        $imagepath =  ($this->logo) ? $this->logo : 'image-not-available.png';
        return '/storage/'.$imagepath;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
