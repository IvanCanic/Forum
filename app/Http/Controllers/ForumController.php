<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Forum;
use App\Section;

class ForumController extends Controller
{
    //

    public function index() {

        $forums = Forum::with('sections.threads.replies')->get();

        return view('forum.index', compact('forums'));

    }

    public function create() {

        return view('forum.create');

    }

    public function store(Request $request) {

        $forum = new Forum();

        $request->validate([
            'title' => 'required|min:3|string'
        ]);

        $forum->title = $request->title;
        $forum->save();

        return redirect()->route('forum');

    }

    public function show($id) {

        $forum = Forum::with('sections.threads.replies')->findOrFail($id);

        //remove duplicated queries
        foreach($forum->sections as $section) {
            $section->replies->load('user');
        }

        return view('forum.show', compact('forum'));
    }

    public function edit($id) {

        $forum = Forum::findOrFail($id);

        return view('forum.edit', compact('forum'));
    }

    public function update(Request $request, $id) {

        $forum = Forum::findOrFail($id);

        $request->validate([
            'title' => 'required|min:3|string'
        ]);

        $forum->title = $request->title;

        $forum->save();

        return redirect()->route('forum');
    }

    public function destroy($id) {

        $forum = Forum::with('sections.threads.replies')->findOrFail($id);

        foreach($forum->sections as $section) {

            $section->replies()->delete();
            $section->threads()->delete();
        }

        $forum->sections()->delete();

        $forum->delete();

        return redirect()->route('forum');

    }
}
