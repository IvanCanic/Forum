@extends('layouts.app')

@section('content')

<div class="vv-container">
    <form action="{{route('store-forum')}}" method="post">
    @csrf
        <div class="vv-group">
            <label for="title">Forum Name</label>
            <input type="text" name="title" id="title" placeholder="Enter a name for your folder" required>
            @error('title') <div class="vv-error">{{$message}}</div> @enderror
        </div>
        <input type="submit" class="vv-btn vv-btn-primary" value="Create Forum">
    </form>
</div>

@endsection