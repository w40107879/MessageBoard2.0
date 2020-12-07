<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic unit test of post.
     *
     * @return void
     */
    public function testPost()
    {
        $first = factory(Post::class)->create();
        $second = factory(Post::class)->create();

        $posts = Post::createPost();
        $this->assertCount(2, $posts);
    }
}
