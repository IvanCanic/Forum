@extends('layouts.app')

@section('content')

<div class="vv-container">
    <article class="forum">
        <div class="forum-head">
            <span>{{$section->title}}</span>
            @if(!Auth::guest() && Auth::user()->role->role_name == 'admin')
            <a href="{{route('edit-section', $section->id)}}" title="Edit section">
            <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

            <!--<a href="{{route('delete-section', $section->id)}}" title="Delete a section">
            <i class="fa fa-trash-o" aria-hidden="true"></i></a> -->
            <div>
            <form action="{{route('delete-section', $section->id)}}" method="post" class="inline-form">
                @csrf 
                @method('DELETE')
                <button type="submit"><i class="fa fa-trash-o" title="Delete a section"></i></button>
            </form>
            </div>
            @endif
            @if(!Auth::guest())
            <a href="{{route('create-thread', $section->id)}}" title="Make a new thread">
            <i class="fa fa-file" aria-hidden="true"></i> Make a new thread</a>
            @endif
        </div>
        <div class="forum-body">
        <!-- Place for lists of threads-->
            <div class="forum-section">
                <div class="forum-section-name">
                    <div>Thread</div>
                </div>
                <div class="forum-information section">
                    <div class="ww-n">Replies</div>
                    <div class="ww-n">Author</div>
                    <div class="ww-m">Updates</div>
                </div>
            </div>
        @if($section->threads->count() > 0)
        @foreach($section->threads as $thread)
            <div class="forum-section">
                <div class="forum-section-name">
                    <h4><a href="{{route('show-thread', $thread->id)}}">{{$thread->title}}</a></h4>
                    <p>{{$thread->description}}</p>
                </div>
                <div class="forum-information section">
                    <div class="ww-n" >{{$thread->replies->count()}}</div>
                    <div class="ww-n" ><a href="{{route('show-profile', $thread->user->id)}}">{{$thread->user->name}}</a></div>
                    <div class="ww-m" >
                        @if($thread->replies->last())
                            <span>posted at <a href="{{route('show-thread', $thread->replies->last()->thread_id ?? '') }}">
                             {{$thread->replies->last()->created_at}}
                            </a>
                            </span>
                            <span>by <a href="{{route('show-profile', $thread->replies->last()->user->id )}}">{{$thread->replies->last()->user->name ?? ''}}</a> </span>
                        @endif
                     </div>
                </div>
            </div>
        @endforeach
        @endif
        </div>
    </article>
</div>

@endsection