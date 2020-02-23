<?php

namespace App;

use App\Notifications\ReplyMarkedAsBestReply;


class Discussion extends Model
{
    public function user()
    {

        return $this->belongsTo(User::class);
    }
     
    public function replies() 
    {
        return $this->hasMany(Reply::class);
    }

    public function getRouteKeyName() 
    {
        return 'slug';
        //This means that during route model binding in the show function inside the Discussion controller
        //Laravel should use the sluf to find the discussion instead of the id
    }

    public function bestReply()
    {
        return $this->belongsTo(Reply::class, 'reply_id');
    }

    public function markAsBestReply(Reply $reply)
    {
        $this->update([
            'reply_id' => $reply->id
        ]);
        if($reply->user->id == $this->user->id){//if the creator of the reply is the author of the discussion

        }
        $reply->user->notify(new ReplymarkedAsBestReply($reply->discussion));// This sends a notification to the user or author of the discussion
        return;
    }

    public function scopeFilterByTopics($builder)
    {
        if(request()->query('topic')){ //checks if there is a request query

            $topic = Topic::where('slug',request()->query('topic'))->first(); //then finds the specific topic we are trying to filter by

            if($topic){
                return $builder->where('topic_id', $topic->id);
            }

            return $builder;
        }
        return $builder;
    }
}
