<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Forum;
use App\Thread;
use App\Reply;

class Section extends Model
{
    //

    public function forum() {

        return $this->belongsTo(Forum::class);
    }

    public function threads() {

        return $this->hasMany(Thread::class);
    }

    public function replies() {

        return $this->hasMany(Reply::class);
    }
}
