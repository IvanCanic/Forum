@extends('layouts.app')

@section('content')

<div class="vv-container">
    @auth
    @if(!Auth::guest() && Auth::user()->role->role_name == 'admin')
    <a href="{{route('create-forum')}}" class="vv-btn-secondary">Create new Forum</a>
    <hr>
    @endif
    @endauth
    <div class="forum">
    @if($forums->count() > 0)
        @foreach($forums as $forum)
            <article class="forum">
                <div class="forum-head">
                    <span><a href="{{route('show-forum', $forum->id )}}">{{$forum->title}}</a></span>

                    @if(!Auth::guest() && Auth::user()->role->role_name == 'admin')

                    <a href="{{route('edit-forum', $forum->id)}}" title="Edit forum">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                    <div>
                        <form action="{{route('delete-forum', $forum->id)}}" method="post" class="inline-form">
                            @csrf 
                            @method('DELETE')
                            <button type="submit"><i class="fa fa-trash-o" title="Delete a forum"></i></button>
                        </form>
                    </div>

                    <a href="{{route('create-section', $forum->id)}}">
                    <i class="fa fa-file" aria-hidden="true"></i> Add new section</a>

                    @endif
                </div>
                <div class="forum-body">
                    <div class="forum-section">
                        <div class="forum-section-name">
                            <div>Forum</div>
                        </div>
                        <div class="forum-information">
                            <div class="ww-n">Threads</div>
                            <div class="ww-n">Replies</div>
                            <div class="ww-m" >Updates</div>
                        </div>
                    </div>
                    @foreach($forum->sections as $section)
                    <div class="forum-section">
                        <div class="forum-section-name">
                            <h4><a href="{{route('show-section', $section->id )}}">{{$section->title}}</a></h4>
                            <p>{{$section->description}}</p>
                        </div>
                        <div class="forum-information">
                            <div class="ww-n">{{$section->threads->count()}}</div>
                            <div class="ww-n">{{$section->replies->count()}}</div>
                            <div class="ww-m">
                                @if($section->replies->last())
                                <span>posted at
                                <a href="{{route('show-thread', $section->replies->last()->thread_id ?? '') }}">
                                {{$section->replies->last()->created_at}}
                                </a>
                                </span> 
                                <span>
                                in <a href="{{route('show-thread', $section->replies->last()->thread_id ?? '') }}">{{$section->replies->last()->thread->title}}</a>
                                </span>
                                <span>by <a href="{{route('show-profile', $section->replies->last()->user->id )}}">{{$section->replies->last()->user->name ?? ''}}</a></span>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </article>
        @endforeach
    @else
    <div class="empty">
    Nema postova!!!
    </div>
    @endif
    </div>
</div>

@endsection