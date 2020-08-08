@extends('layouts.app')

@section('content')
<div class="vv-container">
    <form action="{{route('store-section')}}" method="post">
    @csrf
        <div class="vv-group">
            <label for="section-title">Section Name</label>
            <input type="text" name="title" id="section-title" placeholder="Enter a name for your section" required>
            @error('title') <div class="vv-error">{{$message}}</div> @enderror
        </div>
        <div class="vv-group">
            <label for="section-description">Section Description</label>
            <input type="text" name="description" id="section-description" placeholder="Enter a description for your section" required>
            @error('description') <div class="vv-error">{{$message}}</div> @enderror
        </div>
        <input type="hidden" name="forumId" value="{{$forumId}}">
        <input type="submit" class="vv-btn vv-btn-primary" value="Create Section">
    </form>
</div>
@endsection