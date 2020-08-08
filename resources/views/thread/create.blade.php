@extends('layouts.app')

@section('content')
<div class="vv-container">
    <form action="{{route('store-thread')}}" method="post">
    @csrf
        <div class="vv-group">
            <label for="thread-title">Thread Title</label>
            <input type="text" name="title" id="thread-title" placeholder="Enter a title for your thread" required>
            @error('title') <div class="vv-error">{{$message}}</div> @enderror
        </div>
        <div class="vv-group">
            <label for="thread-description">Thread Description</label>
            <input type="text" name="description" id="thread-description" placeholder="Enter a description for your thread" required>
            @error('description') <div class="vv-error">{{$message}}</div> @enderror
        </div>
        <div class="vv-group">
            <label for="thread-message">Your message</label>
            <textarea name="message" id="thread-message" cols="30" rows="10" required>{{old('message')}}</textarea>
            @error('message') <div class="vv-error">{{$message}}</div> @enderror
        </div>
        <input type="hidden" name="sectionId" value="{{$sectionId}}">
        <input type="hidden" name="userId" value="{{Auth::user()->id}}">
        <input type="submit" class="vv-btn vv-btn-primary" value="Create Thread">
    </form>
</div>
@endsection