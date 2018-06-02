<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ThreadsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_can_browse_threads()
    {
        // Setup threads in Test DB
        $thread = factory('App\Thread')->create();

        // Visit endpoint
        $response = $this->get('/threads');
        // Make sure you see the title of the thread
        $response->assertSee($thread->title);
    }

    /** @test */
    public function a_user_can_read_a_single_thread()
    {
        $thread = factory('App\Thread')->create();
        
        // Make sure you see the title for specific id
        $response = $this->get('/threads/' . $thread->id);
        $response->assertSee($thread->title);
    }
}
