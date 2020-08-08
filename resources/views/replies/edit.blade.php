@extends('layouts.app')

@section('content')

<div class="vv-container">
    <form action="{{route('update-reply', $reply->id)}}" method="post">
        @csrf
        @method('PATCH')
        <div class="vv-group">
            <label for="replay-messsage">New reply</label>
            <!--<textarea name="message" id="replay-message" cols="30" rows="10" required>{{$reply->message}}</textarea>-->
            <!--@error('message') <div class="vv-error">{{$message}}</div> @enderror-->
           
            <input id="short_desc" type="hidden" name="message" value="{{  $reply->message }}" >
            <trix-editor input="short_desc"></trix-editor>

            @error('message') <div class="vv-error">{{$message}}</div> @enderror
        <input type="submit" class="vv-btn vv-btn-primary" value="Post a reply">
    </form>
</div>

@endsection