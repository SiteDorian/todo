<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Task;
use App\Tag;
use App\TaskTag;

class TaskTagController extends Controller
{
    /**
     * Add a tag to task.
     * Create a link between the task and the tag.
     */
    public function link($task_id, $tag_id)
    {
        $task = Task::findOrFail($task_id);
        $tag = Tag::findOrFail($tag_id);

        $result = TaskTag::where('task_id', $task_id)->where('tag_id', $tag_id)->get();
        
        if (! $result->count() ) {
            $tt = new TaskTag();
            $tt->tag_id = $tag->id;
            $tt->task_id = $task->id;
            $tt->save();
        } else {
            return Redirect::back()->with('message', "This tag has already been added!");
        }
        return Redirect::back()->with('message', "A new Tag has been added to this Task");
    }

    /**
     * Find and delete the link between task and tag.
     * Delete TaskTag object.
     * 
     */
    public function destroy($task_id, $tag_id)
    {
        $task = Task::findOrFail($task_id);
        $tag = Tag::findOrFail($tag_id);

        $results = TaskTag::where('task_id', $task_id)->where('tag_id', $tag_id)->get();
        
        if ($results) {
            $result = $results->first();
            $result->delete();
        }

        return Redirect::back();
    }
}
