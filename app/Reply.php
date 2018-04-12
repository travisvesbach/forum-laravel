<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use Favoritable, RecordsActivity;

	protected $guarded = [];

    protected $with = ['owner', 'favorites'];


    // Found in the comments of lesson 31 to fix an issue with favorites not being deleted when deleting a thread.
    protected static function boot() {
        parent::boot();

        static::deleting(function($reply) {
            $reply->favorites->each->delete();
        });
    }

    public function owner() {
    	return $this->belongsTo(User::class, 'user_id');
    }
    public function thread() {
    	return $this->belongsTo(Thread::class);
    }

    public function path() {
    	return $this->thread->path() . "#reply-{$this->id}";
    }

    // Found in the comments of lesson 31 to fix an issue with favorites not being deleted when deleting a thread.
    public function favorites() {
        return $this->morphMany(Favorite::class, 'favorited');
    }    


}
