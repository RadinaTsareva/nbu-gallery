@extends('layouts.app')
@section('content')
<div class="container">

    <div class="starter-template">
        <div class="media">
            <div class="row align-items-center justify-content-md-center">
                <div class="col-4">
                    <img class="img-thumbnail" alt="{{$album->name}}" src="/albums/{{$album->cover_image}}">
                </div>
                <div class="col-4">
                    <div class="media-body">
                        <p class="h4">Album Name:</p>
                        <p class="h5">{{$album->name}}</p>
                        <div class="media">
                            <p class="h4">Album Description:</p>
                            <p class="h5">{{$album->description}}</p>
                            @if(Auth::id() == $album->user->id)
                            <form method="POST" action="{{route('delete-album',array('id'=>$album->id))}}">
                                @csrf
                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                    <a class="btn btn-primary" href="{{route('add-photo',array('id'=>$album->id))}}">
                                        <span>Add Image</span>
                                    </a>
                                    <button type="submit" onclick="return confirm('Are you sure?')"
                                        class="btn btn-danger">Delete Album</button>
                                </div>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr />
    @if(count($album->Photos) == 0)
    <div class="alert alert-info w-50 m-auto" role="alert">
        Nothing to see here...
    </div>
    @else
    <div class="row align-items-center row-cols-3">
        @foreach($album->Photos as $photo)
        <div class="col">
            <div class="thumbnail">
                <img class="img-thumbnail rounded mx-auto d-block" alt="{{$album->name}}"
                    src="/albums/{{$album->id}}/{{$photo->image}}">
                <div class="caption">
                    <p>{{$photo->description}}</p>
                    <p>Created: {{ date("d F Y",strtotime($photo->created_at)) }}
                        at {{ date("h:ia",strtotime($photo->created_at)) }}</p>
                    @if(Auth::id() == $album->user->id)
                    <form method="POST" action="{{route('delete-photo',array('id'=>$photo->id))}}">
                        @csrf
                        <fieldset>
                            <button type="submit" onclick="return confirm('Are you sure?')"
                                class="btn btn-danger btn-small">Delete Image</button>
                        </fieldset>
                    </form>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection