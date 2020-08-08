<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Section;

class SectionController extends Controller
{
    //

    public function create($forumId) {

        return view('section.create', compact('forumId'));
    }

    public function store(Request $request) {

        $section = new Section();

        $request->validate([
            'title' => 'required|min:3|string',
            'description' => 'required|min:3|string'
        ]);

        $section->title = $request->title;
        $section->description = $request->description;
        $section->forum_id = $request->forumId;

        $section->save();

        return redirect()->route('forum');
    }

    public function show($id) {

        $section = Section::with('threads.replies')->findOrFail($id);

        //remove duplicated queries
        $section->threads->load('user');

        return view('section.show', compact('section'));
    }

    public function edit($id) {

        $section = Section::findOrFail($id);

        return view('section.edit', compact('section'));
    }

    public function update(Request $request, $id) {

        $section = Section::findOrFail($id);

        $request->validate([
            'title' => 'required|min:3|string',
            'description' => 'required|min:3|string'
        ]);

        $section->title = $request->title;
        $section->description = $request->description;

        $section->save();

        return redirect()->route('forum');

    }

    public function destroy($id) {

        $section = Section::with('threads.replies', 'replies')->findOrFail($id);

        $section->replies()->delete();
        $section->threads()->delete();

        $section->delete();

        return redirect()->route('forum');

    }
}
