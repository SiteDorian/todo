<?php

namespace App\Http\Controllers;

use App\Tag;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TagController extends Controller
{
    /**
     * Show all Tags
     * 
     */
    public function index()
    {
        $tags = Tag::all();

        return view("taglist", [
            'tags' => $tags,
        ]);
    }

    /**
     * Create a new Tag
     * 
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:tags|max:25',
        ]);

        // The tag is valid...
        $tag = new Tag();
        $tag->name = request("name");
        $tag->save();

        return Redirect::back()->with("message", "Tag has been added");       
    }

    /**
     * Delete a Tag
     * 
     */
    public function destroy($id)
    {
        $tag = Tag::find($id);
        $tag->delete();
        return Redirect::back()->with('message', "Tag has been deleted");
    }

    /**
     * Edit a Tag
     * 
     */
    public function edit($id)
    {
        $tag = Tag::findOrFail($id);
        return view('edit_tag', compact('tag'));
    }

    public function update(Tag $tag)
    {
        $data = request()->validate([
            'name' => 'required|unique:tags|max:25',
        ]);

        $tag->update($data);

        return redirect("/tags");
    }
}
