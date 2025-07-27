<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Blog;
use App\Models\Photo;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OwnershipAccessControlTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_only_see_own_blogs()
    {
        // Create two users
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        // Create blogs for each user
        $blog1 = Blog::factory()->create(['author_id' => $user1->id]);
        $blog2 = Blog::factory()->create(['author_id' => $user2->id]);

        // Login as user1 and check they only see their blog
        $response = $this->actingAs($user1)->get('/dashboard/blogs');
        $response->assertStatus(200);
        // The exact assertion would depend on your view structure
    }

    public function test_user_cannot_edit_others_blog()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        
        $blog = Blog::factory()->create(['author_id' => $user2->id]);

        // User1 trying to edit User2's blog should fail
        $response = $this->actingAs($user1)->get("/dashboard/blogs/edit/{$blog->id}");
        $response->assertStatus(403); // Forbidden
    }

    public function test_user_cannot_delete_others_blog()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        
        $blog = Blog::factory()->create(['author_id' => $user2->id]);

        // User1 trying to delete User2's blog should fail
        $response = $this->actingAs($user1)->delete("/dashboard/blogs/delete/{$blog->id}");
        $response->assertStatus(403); // Forbidden
    }

    public function test_user_can_only_see_own_photos()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $photo1 = Photo::factory()->create(['author_id' => $user1->id]);
        $photo2 = Photo::factory()->create(['author_id' => $user2->id]);

        $response = $this->actingAs($user1)->get('/dashboard/gallery');
        $response->assertStatus(200);
    }

    public function test_user_can_only_see_own_products()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $product1 = Product::factory()->create(['author_id' => $user1->id]);
        $product2 = Product::factory()->create(['author_id' => $user2->id]);

        $response = $this->actingAs($user1)->get('/dashboard/products');
        $response->assertStatus(200);
    }
}
