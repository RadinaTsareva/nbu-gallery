@extends('layouts.app')
@section('content')
    <div class="container" style="text-align: center;">
        <div class="span4" style="display: inline-block;margin-top:100px;">

            @if($errors->any())
                <div class="alert alert-block alert-error fade in" id="error-block">
                        <?php
                        $messages = $errors->all('<li>:message</li>');
                        ?>
                    <button type="button" class="close" data-dismiss="alert">×</button>

                    <h4>Warning!</h4>
                    <ul>
                        @foreach($messages as $message)
                            {{$message}}
                        @endforeach

                    </ul>
                </div>
            @endif

            <form name="createnewphoto" method="POST" action="{{route('add-photo', $id)}}" enctype="multipart/form-data">
                @csrf
                <fieldset>
                    <legend>Add a Photo</legend>
                    <div class="form-group">
                        <label for="name">Photo Name</label>
                        <input name="name" type="text" class="form-control" placeholder="Photo Name"
                               value="{{old('name')}}">
                    </div>
                    <div class="form-group">
                        <label for="description">Photo Description</label>
                        <textarea name="description" type="text" class="form-control"
                                  placeholder="Photo description">{{old('description')}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="image">Select a Photo</label>
                        <input type="file" name="image" id="image"/>
                    </div>
                    <button type="submit" class="btn btn-default">Create!</button>
                </fieldset>
            </form>
        </div>
    </div> <!-- /container -->
@endsection
