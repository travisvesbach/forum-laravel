<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
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
    	return '/threads/' . $this->id;
    }

    public function replies() {
    	return $this->hasMany(Reply::class);
    }

    public function creator() {
    	return $this->belongsTo(User::class, 'user_id');
    }

    public function addReply($reply) {
    	$this->replies()->create($reply);
    }
}
