<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ReadThreadsTest extends TestCase
{
    use DatabaseMigrations;

    protected $thread;

    public function setUp()
    {
        // We are extending TestCase
        // Make sure you call parent setup
        parent::setUp();

        // Setup threads in Test DB
        $this->thread = factory('App\Thread')->create();
    }

    /** @test */
    public function a_user_can_browse_threads()
    {
        // Visit endpoint
        // Make sure you see the title of the thread
        $this->get('/threads')
            ->assertSee($this->thread->title);
    }

    /** @test */
    public function a_user_can_read_a_single_thread()
    {
        // Make sure you see the title for specific id
        $this->get('/threads/' . $this->thread->id)
            ->assertSee($this->thread->title);
    }

    /** @test */
    function a_user_can_read_replies_associated_with_a_thread()
    {
        // Given we have a thread
        // And that thread includes replies
        $reply = factory('App\Reply')
            ->create(['thread_id' => $this->thread->id]);
        // When we visit a thread page we should see reply body
        $this->get('/threads/' . $this->thread->id)
            ->assertSee($reply->body);
    }
}
