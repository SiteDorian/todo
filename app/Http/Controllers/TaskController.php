<?php

namespace App\Http\Controllers;

use App\Task;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TaskController extends Controller
{
    /**
     * Set server timezone.
     */
    public function __construct()
    {
        date_default_timezone_set("Europe/Chisinau");
    }
    /**
     * Show all Tasks or filter tasks
     * 
     */
    public function index()
    {
        // $tasks =  Task::all();
        $tasks = new Task();

        $queris = [];

        if (request()->has('tag')) {
            $tagID = request('tag');

            $tasks = $tasks->select('tasks.*');
            $tasks = $tasks->join('task_tags', 'task_tags.task_id', '=',  'tasks.id');
            $tasks = $tasks->join('tags', 'task_tags.tag_id', '=',  'tags.id');

            $tasks = $tasks->where('tags.id', '=', $tagID);
        }

        if (request()->has('trip-start')) {
            $date_start = request('trip-start');
            $tasks = $tasks->where('tasks.created_at', '>=', $date_start.' 00:00:00');
        }

        if (request()->has('trip-end')) {
            $date_end = request('trip-end');
            $tasks = $tasks->where('tasks.created_at', '<=', $date_end.' 00:00:00');
        }

        $tasks = $tasks->get();
        

        $tags = Tag::all();
        
        return view("welcome", compact("tasks", 'tags') );
    }

    /**
     * Create a new Task
     * 
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'url' => 'image|mimes:jpeg,png',
        ]);

        $task = new Task();
        $task->name = request("name");

        if ($request->hasFile('url')) 
        {
            $task->url = request("url")->store('uploads', 'public');
        }

        $task->save();
        return Redirect::back()->with("message", "Task has been added");
    }

    /**
     * Delete a Task
     * 
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();
        return Redirect::back()->with('message', "Task has been deleted");
    }

    /**
     * Edit Task page
     * 
     */
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        $tags = Tag::all();

        return view('edit_task', compact('task', 'tags'));
    }
    

    /**
     * Update the Task
     */
    public function update(Task $task)
    {
        $data = request()->validate([
            'name' => 'required:tasks|max:25',
            'url' => 'image|mimes:jpeg,png',
        ]);

        $new_lines = [];
        $new_lines['name'] = $data['name'];

        if (request()->hasFile('url')) 
        {
            $new_lines['url'] = request("url")->store('uploads', 'public');
        }

        $task->update($new_lines);

        return redirect("/");
    }
}
