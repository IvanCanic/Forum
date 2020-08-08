@extends('layouts.app')

@section('content')

<div class="vv-container">

    <form action="{{route('update-profile', $user->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="vv-group">
            <label for="username">Change your nickname</label>
            <input type="text" name="username" value="{{$user->name}}">
            @error('username') <div class="vv-error">{{$message}}</div> @enderror
        </div>
        <div class="vv-group">
            <label for="avatar">Change your avatar</label>
            <input type="file" name="avatar">
        </div>
        @if(!Auth::guest() && Auth::user()->role->role_name == 'admin')
        <div class="vv-group-2">
            <h2>Change usergroup</h2>
            @foreach($roles as $key => $role)
            <label for="{{$role->role_name}}-{{$key}}">{{$role->role_name}}</label>
            <input type="radio" name="role_id" value="{{$role->id}}" id="{{$role->role_name}}-{{$key}}"
            @if($role->id == $user->role->id) checked @endif >
            @endforeach
        </div>
        @endif
        <input type="submit" class="vv-btn vv-btn-primary" value="Edit profile">
    </form>

</div>

@endsection