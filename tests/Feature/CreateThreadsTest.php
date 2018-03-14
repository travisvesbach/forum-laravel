<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateThreadsTest extends TestCase
{
	use RefreshDatabase;
    /** @test */
    function guests_may_not_make_threads() {

    	$this->expectException('Illuminate\Auth\AuthenticationException');

    	$thread = make('App\Thread');

    	$this->post('/threads', $thread->toArray());

    }


    /** @test */
    function an_authenticated_user_can_create_new_forum_threads() {

        $this->signIn();

    	$thread = make('App\Thread');

    	$this->post('/threads', $thread->toArray());
			
		$this->get($thread->path())
			->assertSee($thread->title)
			->assertSee($thread->body);
    }
}
