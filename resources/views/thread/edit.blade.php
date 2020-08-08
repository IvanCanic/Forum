@extends('layouts.app')

@section('content')
<div class="vv-container">
    <form action="{{route('update-thread', $thread->id)}}" method="post">
    @csrf
    @method('PATCH')
        <div class="vv-group">
            <label for="thread-title">Thread Title</label>
            <input type="text" name="title" id="thread-title" placeholder="Enter a title for your thread" value="{{$thread->title}}" required>
            @error('title') <div class="vv-error">{{$message}}</div> @enderror
        </div>
        <div class="vv-group">
            <label for="thread-description">Thread Description</label>
            <input type="text" name="description" id="thread-description" placeholder="Enter a description for your thread" value="{{$thread->description}}" required>
            @error('description') <div class="vv-error">{{$message}}</div> @enderror
        </div>
        <div class="vv-group">
            <label for="thread-message">Your message</label>
            <textarea name="message" id="thread-message" cols="30" rows="10" required>{{$thread->message}}</textarea>
            @error('message') <div class="vv-error">{{$message}}</div> @enderror
        </div>
        <input type="submit" class="vv-btn vv-btn-primary" value="Save Changes">
    </form>
</div>
@endsection