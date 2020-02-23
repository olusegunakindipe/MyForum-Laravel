<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDiscussionRequest;
use Illuminate\Support\Str;
use App\Discussion;
use App\Reply;

class DiscussionsController extends Controller
{
    
      //we can validate using middleware from our route file or constructor
     public function __construct() {
         $this->middleware(['auth','verified'])->only(['create', 'store']);
     }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     
        return view('discussions.index', [
            'discussions'=> Discussion::filterByTopics()->paginate(3)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('discussions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateDiscussionRequest $request)
    {
        //
        auth()->user()->discussions()->create([ //discussions id a hasmany relationship between user and discussion
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'topic_id' => $request->topic
            // 'user_id'=>$request->user This can be done or the above
        ]);
        session()->flash('success', 'Discussion Posted');

       return redirect(route('discussions.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Discussion $discussion)
    {
        
        //we are using the slug here for id and not the id, so we cannot do Discussion $discussion
        return view('discussions.show', [
            'discussion'=> $discussion
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function reply(Discussion $discussion, Reply $reply)
    {
        $discussion->markAsBestReply($reply);

        session()->flash('success', 'Marked as Best Reply');

        return redirect()->back();
    }
}
