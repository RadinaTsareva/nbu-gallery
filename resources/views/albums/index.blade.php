@extends('layouts.app')
@section('content')
    <div class="container">

        <div class="starter-template">

            <div class="row">
                @foreach($albums as $album)
                    <div class="col-lg-3">
                        <div class="thumbnail">
                            <img alt="{{$album->name}}" src="/albums/{{$album->cover_image}}" style="max-width: 100%">
                            <div class="caption">
                                <h3>{{$album->name}}</h3>
                                <p>{{$album->description}}</p>
                                <p>{{count($album->Photos)}} image(s).</p>
                                <p>Created date: {{ date("d F Y",strtotime($album->created_at)) }}
                                    at {{date("g:ha",strtotime($album->created_at)) }}</p>
                                <p><a href="{{route('list-of-albums',['id'=>$album->id])}}"
                                      class="btn btn-big btn-default">Show Gallery</a></p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
@endsection
