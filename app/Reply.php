<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Thread;
use App\User;
use App\Section;

use Te7aHoudini\LaravelTrix\Traits\HasTrixRichText;

class Reply extends Model
{
    //

    use HasTrixRichText;

    public function thread() {

        return $this->belongsTo(Thread::class);

    }

    public function user() {

        return $this->belongsTo(User::class);

    }

    public function section() {

        return $this->belongsTo(Section::class);
    }
}
