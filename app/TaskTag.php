<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskTag extends Model
{
    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
