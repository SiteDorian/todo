<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $guarded = [];
    
    public function taskTags()
    {
        return $this->hasMany(TaskTag::class);
    }
}
