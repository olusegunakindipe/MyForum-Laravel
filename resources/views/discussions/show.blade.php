@extends('layouts.app')

@section('content')
   
    <div class="card">
    @include('partials.discussion-header')

        <div class="card-body">
            <div class="text-center"> 
                
                <strong> {!! $discussion->title !!} </strong>
            
            </div>
            {!!$discussion->reply!!}
            @if($discussion->bestReply)
                <div class="card bg-success">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <div>
                                <img width="40px" height="40px" style="border-radius:50%" src="{{Gravatar::src($discussion->bestReply->user->email)}}" alt="">
                                <strong>
                                    {{$discussion->bestReply->user->name}}
                                </strong>
                            </div>
                        <div>                        
                            <strong>
                                BEST REPLY
                            </strong>
                        </div>
                    </div>
                    <div class="card-body">
                        {!!$discussion->bestReply->reply!!}
                    </div>
                    
                </div>
            @endif
        </div>
    </div>
      @foreach($discussion->replies()->paginate(3) as $reply)
        <div class="card my-5">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div>
                        <img width="40px" height="40px" style="border-radius:50%" src="{{Gravatar::src($reply->user->email)}}" alt="">
                        <span>{{$reply->user->name}}</span>
                    </div>
                    <div>
                        @auth
                            @if(auth()->user()->id == $discussion->user_id)
                                <form action="{{route('discussions.best-reply',['discussion' => $discussion->slug, 'reply' => $reply->id]) }}" method="POST">
                                    @csrf
                                    <button type= "submit" class="btn btn-sm btn-primary"> Mark as best reply</button> 

                                </form>
                            @endif
                        @endauth
                    </div>
                
                </div>
            
            </div>
            <div class="card-body">
                {!! $reply->reply !!}
            </div>
        
        </div>
        
      @endforeach
      {{$discussion->replies()->paginate(3)->links()}}
    <div class="card my-5">
        <div class="card-header">
            Add a  reply
        </div>
        <div class="card-body">
            @auth
            <form action="{{route('replies.store', $discussion->slug)}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="reply">Reply</label>
                    <input id="reply" type="hidden" name="reply">
                    <trix-editor input="reply"></trix-editor>
                </div>

                <button type="submit" class="btn btn-success my-2"> Add Reply</button>
            </form>
       
            @else
            <a href="{{route('login')}}" class="btn btn-info" style="color:#fff">Sign in to add a reply</a>
            @endauth
        
        </div>
    </div>
@endsection



@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css">

@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js"></script>

@endsection


