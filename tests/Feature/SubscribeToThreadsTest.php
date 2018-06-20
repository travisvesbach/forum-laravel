<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubscribeToThreadsTest extends TestCase
{

    use RefreshDatabase;

    /** @test **/
    public function a_user_can_subcribe_to_threads() {
        $this->signIn();

        // Given we have a thread...
        $thread = create('App\Thread');

        // and the user subscribes to the thread...
        $this->post($thread->path() . '/subscriptions');

        // then, each time a new reply is left...
        $thread->addReply([
            'user_id' => auth()->id(),
            'body' => 'Some reply here'
        ]);

        // a notification should be prepared for the user.

    }

}
