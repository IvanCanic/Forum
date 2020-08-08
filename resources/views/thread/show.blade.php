@extends('layouts.app')

@section('content')

<div class="vv-container">
    <article class="forum">
        <div class="forum-head">
            <span>{{$thread->title}}</span>
        </div>
        <div class="forum-body">
            <div class="forum-thread-meta">
                Date: {{$thread->created_at}}
            </div>
            <div class="forum-thread">
                <div class="forum-thread-author">
                    <a href="{{route('show-profile', $thread->user->id)}}">{{$thread->user->name}}</a>
                    @if($thread->user->avatar)
                    <img src="{{asset('storage/'. $thread->user->avatar)}}" alt="avatar">
                    @else
                    <img src="{{asset('images/avatar.jpg')}}" alt="avatar">
                    @endif
                    <span class="user-group">Group: {{$thread->user->role->role_name}}</span>
                </div>
                <div class="forum-thread-body">
                    {{$thread->message}}
                </div>
            </div>
            <div class="post-footer">
                @auth
                @if(!Auth::guest() && Auth::user()->role->role_name == 'admin' or Auth::user()->id == $thread->user_id)
                <a href="{{route('edit-thread', $thread->id)}}" class="vv-btn vv-btn-primary">Edit thread</a>
                <form action="{{route('delete-thread', $thread->id)}}" method="post" class="delete">
                    @csrf
                    @method('DELETE')
                    <input class="vv-btn vv-btn-delete" type="submit" value="Delete thread">
                </form>
                @endif
                @endauth
            </div>
        </div>
    </article>
    <!-- show all replais-->
    @foreach($thread->replies as $reply)
        <article class="forum">
            <div class="forum-body">
                <div class="forum-thread-meta">
                   <div class="reply-date" > Date: {{$reply->created_at}} </div>
                </div>
                <div class="forum-thread">
                    <div class="forum-thread-author">
                        <a href="{{route('show-profile', $reply->user->id)}}">{{$reply->user->name}}</a>
                        @if($reply->user->avatar)
                        <img src="{{asset('storage/'. $reply->user->avatar)}}" alt="avatar">
                        @else
                        <img src="{{asset('images/avatar.jpg')}}" alt="avatar">
                        @endif
                        <span class="user-group">Group: {{$reply->user->role->role_name}}</span>
                    </div>
                    <div class="forum-thread-body">
                        {!! $reply->message !!}
                    </div>
                </div>
                <div class="post-footer">
                    @auth
                    @if(!Auth::guest() && Auth::user()->role->role_name == 'admin' or Auth::user()->id == $reply->user_id)
                    <a href="{{route('edit-reply', $reply->id)}}" class="vv-btn vv-btn-primary">Edit post</a>
                    <form action="{{route('delete-reply', $reply->id)}}" method="post" class="delete">
                        @csrf
                        @method('DELETE')
                        <input class="vv-btn vv-btn-delete" type="submit" value="Delete post">
                    </form>
                    @endif
                    @endauth
                </div>
            </div>
        </article>
    @endforeach
    <!-- Form for a replies-->
    <div class="add-replies">
    @if(Auth::guest())
        <div>
        <a href="{{route('login')}}" class="vv-btn vv-btn-secondary">Please log in to make a comment</a>
        </div>
    @else
        <form action="{{route('store-reply')}}" method="post">
            @csrf
            <div class="vv-group">
                <label for="replay-messsage">New reply</label>
                <!-- <textarea name="message" id="replay-message" cols="30" rows="10" required></textarea> -->
                
                <!-- adding a trix editor -->
                @trix(\App\Reply::class, 'content')

                @error('reply-trixFields.content') <div class="vv-error">{{$message}}</div> @enderror
            </div>
            <input type="hidden" name="userId" value="{{Auth::user()->id}}">
            <input type="hidden" name="threadId" value={{$thread->id}}>
            <input type="hidden" name="sectionId" value={{$thread->section_id}}>
            <input type="submit" class="vv-btn vv-btn-primary" value="Post a reply">
        </form>
    @endif
    </div>
</div>

@endsection