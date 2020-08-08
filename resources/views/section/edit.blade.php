@extends('layouts.app')

@section('content')
<div class="vv-container">
    <form action="{{route('update-section', $section->id)}}" method="post">
    @csrf
    @method('PATCH')
        <div class="vv-group">
            <label for="section-title">Section Name</label>
            <input type="text" name="title" id="section-title" placeholder="Enter a name for your section" value="{{$section->title}}" required>
            @error('title') <div class="vv-error">{{$message}}</div> @enderror
        </div>
        <div class="vv-group">
            <label for="section-description">Section Description</label>
            <input type="text" name="description" id="section-description" placeholder="Enter a description for your section" value="{{$section->description}}" required>
            @error('description') <div class="vv-error">{{$message}}</div> @enderror
        </div>
        <input type="submit" class="vv-btn vv-btn-primary" value="Update Section">
    </form>
</div>
@endsection