<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Section;
use App\User;
use App\Reply;

class Thread extends Model
{
    //

    public function section() {

        return $this->belongsTo(Section::class);

    }

    public function user() {

        return $this->belongsTo(User::class);
    }

    public function replies() {

        return $this->hasMany(Reply::class);
    }
}
