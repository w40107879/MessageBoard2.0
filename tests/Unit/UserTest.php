<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Post;

class UserTest extends TestCase
{
    //重置DB
    use RefreshDatabase;

    public function testCreatPost()
    {
        //test send post
        $response = $this->post(
            route('posts.create'),
            [
                'title' => $this->faker->sentence,
                'body'  => $this->faker->paragraph
            ]
        );
        $response->assertStatus(200);
    }

    /**
     * A basic unit test of post.
     *
     * @return void
     */
    public function testGetPost()
    {
        //test get post
        $response = $this->get(route('posts.show'));
        $response->assertStatus(200);
    }

    public function testGetPostById()
    {
        $post = factory(Post::class)->create();
        $response = $this->get(route('posts.name',$post->id));
        $response->assertStatus(200);
    }

    public function testEditPost()
    {
        //test edit post
        $post = factory(Post::class)->create();
        $response = $this->put(
            route('posts.edit',$post->id),
            [
                'title' => $this->faker->sentence,
                'body' => $this->faker->paragraph
            ]
        );
        $response->assertStatus(200);
    }

    public function testDeletePost()
    {
        $post = factory(Post::class)->create();
        $response = $this->delete(route('posts.delete',$post->id));
        $response->assertStatus(200);
    }
}
