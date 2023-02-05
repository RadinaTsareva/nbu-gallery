@extends('layouts.app')
@section('content')
<div class="container" style="text-align: center;">
    <div class="span4" style="display: inline-block;">

        @if($errors->any())
        <div class="alert alert-warning alert-dismissible fade show" id="error-block">
            <h4>Warning!</h4>
            <ul>
                @foreach($errors->all(':message') as $message)
                <li>{{$message}}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form name="createnewphoto" method="POST" action="{{route('add-photo', $id)}}" enctype="multipart/form-data">
            @csrf
            <fieldset>
                <legend>Add a Photo</legend>
                <div class="form-group mb-3">
                    <label for="name" class="form-label">Photo Name</label>
                    <input autocomplete="off" name="name" type="text" class="form-control" placeholder="Photo Name"
                        value="{{old('name')}}">
                </div>
                <div class="form-group mb-3">
                    <label for="description" class="form-label">Photo Description</label>
                    <textarea name="description" type="text" class="form-control"
                        placeholder="Photo description">{{old('description')}}</textarea>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Select a photo</label>
                    <input class="form-control" name="image" type="file" id="image">
                </div>
                <button type="submit" class="btn btn-default">Create!</button>
            </fieldset>
        </form>
    </div>
</div> <!-- /container -->
@endsection