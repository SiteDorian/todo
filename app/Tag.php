<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $guarded = [];
    
    public function taskTags()
    {
        return $this->hasMany(TaskTag::class);
    }
}
