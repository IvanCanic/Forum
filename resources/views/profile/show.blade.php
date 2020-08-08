@extends('layouts.app')

@section('content')

<div class="vv-container">
    <div class="profile">
        <div class="profile-name">Nickname: {{$user->name}}</div>
        <div class="profile-avatar">
            @if($user->avatar)
                <img src="{{asset('storage/'. $user->avatar)}}" alt="avatar">
            @else
                <img src="{{asset('images/avatar.jpg')}}" alt="avatar">
            @endif
        </div>
        <div class="profile-group">Usergroup: {{$user->role->role_name}}</div>
        @auth
        @if(!Auth::guest() && Auth::user()->role->role_name == 'admin' OR Auth::user()->id == $user->id)
        <a href="{{route('edit-profile', $user->id)}}" class="vv-btn vv-btn-primary">Edit profile</a>
        @endif
        @endauth
    </div>
</div>

@endsection