<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{

    protected static function boot() {
        parent::boot();

        static::addGlobalScope('replyCount', function($builder) {
            $builder->withCount('replies');
        });
    }

    /**
     * Don't auto-apply mass assignment protection.
     *
     * @var array
     */
	protected $guarded = [];

    /**
     * Get a string path for the thread.
     *
     * @return string
     */
    public function path() {
        return "/threads/{$this->channel->slug}/{$this->id}";
    }

    public function replies() {
    	return $this->hasMany(Reply::class)->withCount('favorites')->with('owner');
    }

    public function creator() {
    	return $this->belongsTo(User::class, 'user_id');
    }

    public function channel() {
        return $this->belongsTo(Channel::class, 'channel_id');
    }

    public function addReply($reply) {
    	$this->replies()->create($reply);
    }

    public function scopeFilter($query, $filters) {
        return $filters->apply($query);
    }
}
