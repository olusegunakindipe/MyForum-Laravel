@extends('layouts.app')

@section('content')
   
    <div class="card">
        <div class="card-header">Add Discussions</div>

        <div class="card-body">
            <form action="{{route('discussions.store')}}" method="POST">
            @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control" value="">
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <input id="content" type="hidden" name="content">
                    <trix-editor input="content"></trix-editor>
                </div>
                <div class="form-group">
                    <label for="content"> Topic</label>
                    <select name="topic" class="form-control" id="topic" name="topic">
                    @foreach($topics as $topic)
                        <option value="{{$topic->id}}">{{$topic->name}}</option>
                    @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success"> Create Topic</button>
                </div>
            </form>
            
        </div>
    </div>
      

@endsection


@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css">

@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js"></script>

@endsection



