<?php

namespace Tests\Feature;

use App\Models\Star;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class StarTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function should_get_list_of_star(): void
    {
        // Create some stars
        Star::factory(10)->create();

        $response = $this->get('/api/star');

        $response->assertStatus(200);
        $response->assertJsonStructure(["current_page", "per_page", "total"]);
    }

    /** @test */
    public function should_get_ten_star_by_page(): void
    {
        Star::factory(31)->create();

        // Maybe a better way to do this, with parallels requests?
        $responsePage1 = $this->get('/api/star?page=1');
        $responsePage2 = $this->get('/api/star?page=2');
        $responsePage3 = $this->get('/api/star?page=3');

        $responsePage1->assertJsonCount(10, "data");
        $responsePage2->assertJsonCount(10, "data");
        $responsePage3->assertJsonCount(10, "data");
    }

    /** @test */
    public function should_not_be_able_to_create_a_star_unauthenticated(): void
    {
        /** Payload is not even necessary since it should fail auth first! */
        $response = $this->post('/api/star', []);

        $response->assertStatus(401);
    }

    /** @test */
    public function should_be_able_to_create_a_star_authenticated_with_good_payload(): void
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $payload = [
            "firstname" => "Morgan",
            "lastname" => "Freeman",
            "description" => ["C'est une star", "Peut être ?"],
            "image" => UploadedFile::fake()->image('testImage.jpg')
        ];

        $response = $this->post('/api/star', $payload);

        $response->assertStatus(201);
        $response->assertJsonStructure(["id", "firstname", "lastname", "description", "image", "id", "created_at"]);
    }
}
