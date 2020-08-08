<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Section;

class Forum extends Model
{
    //

    public function sections() {

        return $this->hasMany(Section::class);
    }
}
