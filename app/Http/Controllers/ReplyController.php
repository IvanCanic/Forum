<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Reply;

class ReplyController extends Controller
{
    //

    public function store(Request $request) {

        $reply = new Reply();

        $request->validate([
            //'message' => 'required|max:5000'
            'reply-trixFields.content' => 'required|max:5000'
        ]);

        $reply->user_id = $request->userId;
        $reply->thread_id = $request->threadId;
        //$reply->message = $request->message;

        $reply->section_id = $request->sectionId;

        $reply->message = request('reply-trixFields.content');

        //dd(request('reply-trixFields.content'));

        $reply->save();

        return redirect()->back();
    }

    public function edit($id) {

        $reply = Reply::findOrfail($id);

        return view('replies.edit', compact('reply'));
    }

    public function update(Request $request, $id) {

        $reply = Reply::findOrFail($id);

        $request->validate([
            'message' => 'required|max:5000'
        ]);

        $reply->message = $request->message;

        $reply->save();

        return redirect()->route('show-thread', $reply->thread_id);

    }

    public function destroy($id) {

        $reply = Reply::findOrFail($id);

        $reply->delete();

        return redirect()->route('show-thread', $reply->thread_id);
    }
}
