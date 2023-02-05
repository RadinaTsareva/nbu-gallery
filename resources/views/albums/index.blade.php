@extends('layouts.app')
@section('content')
<div class="container">

    <div class="starter-template">
        <div class="row align-items-center">
            @foreach($albums as $album)
            <div class="col">
                <div class="thumbnail" style="max-width:200px">
                    <img class="img-fluid rounded mx-auto d-block" alt="{{$album->name}}"
                        src="/albums/{{$album->cover_image}}" />
                    <div class="caption">
                        <p class="h4">Name: {{ $album->name }} ({{ count($album->Photos) }})</p>
                        <p class="h5">Description: {{$album->description}}</p>
                        <p class="h5">Created: {{ date("d F Y",strtotime($album->created_at)) }}
                            at {{ date("h:ia",strtotime($album->created_at)) }}</p>
                        @if(Auth::id() != $album->user->id)
                        <p class="h6">Creator: {{ $album->user->name }}</p>
                        @endif
                        <a href="{{route('get-album',['id'=>$album->id])}}" class="btn btn-big btn-info">Show
                            Gallery</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection