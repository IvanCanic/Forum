<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Thread;

class ThreadController extends Controller
{
    //

    public function create($sectionId) {

        return view('thread.create', compact('sectionId'));
    }

    public function store(Request $request) {

        $thread = new Thread();

        $request->validate([
            'title' => 'required|min:3|string',
            'description' => 'required|min:3|string',
            'message' => 'required|string'
        ]);

        $thread->title = $request->title;
        $thread->description = $request->description;
        $thread->message = $request->message;
        $thread->section_id = $request->sectionId;
        $thread->user_id = $request->userId;

        $thread->save();

        return redirect()->route('forum');
    
    }

    public function show($id) {

        $thread = Thread::with('replies')->findOrFail($id);

        //remove duplicated queries
        $thread->replies->load('user.role');
        $thread->user->load('role');

        return view('thread.show', compact('thread'));
    }

    public function edit($id) {

        $thread = Thread::findOrfail($id);

        return view('thread.edit', compact('thread'));
    }

    public function update(Request $request, $id) {

        $thread = Thread::findOrFail($id);

        $request->validate([
            'title' => 'required|min:3|string',
            'description' => 'required|min:3|string',
            'message' => 'required|string'
        ]);

        $thread->title = $request->title;
        $thread->description = $request->description;
        $thread->message = $request->message;

        $thread->save();

        return redirect()->route('show-thread', $thread->id);
    }

    public function destroy($id) {

        $thread = Thread::with('replies')->findOrFail($id);

        $thread->replies()->delete();

        $thread->delete();

        return redirect()->route('forum');
    }
}
