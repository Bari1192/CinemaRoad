<?php

namespace Tests\Unit\Models;

use App\Models\Movie;
use App\Models\Purchase;
use App\Models\Screening;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Symfony\Component\HttpClient\Internal\PushedResponse;
use Tests\TestCase;

class PurchaseTest extends TestCase
{
    use DatabaseTransactions;

    public function test_it_uses_the_correct_database() {
        $purchase = new Purchase;

        $this->assertSame('purchases', $purchase->getTable());
    }

    public function test_it_has_the_correct_fillable_attributes() {
        $purchase = new Purchase;

        $this->assertEquals(
            ['location_id',
                        'screening_id',
                        'movie_id',
                        'ticket_code',
                        'guest_email',
                        'parkingspot',
                        'user_id',
                        'created_at',
                        'updated_at'],
            
                        $purchase->getFillable()
        );
    }

    public function test_purchase_belongs_to_a_movie()
    {
        $movie = Movie::create([
            'title' => 'Test Movie',
            'description' => 'test description',
            'type' => 'action',
            'release_date' => '2020-01-01',
            'director' => 'Test Director',
            'duration_min' => 120,
            'poster_url' => 'test.jpg',
            'actors' => 'TestActor1, TestActor2'
        ]);

        $purchase = Purchase::create([
            'screening_id' => 1,
            'location_id' => 1,
            'movie_id' => $movie->id,
            'user_id' => 1,
            'ticket_code' => 'ABC123',
            'guest_email' => null,
            'parkingspot' => 'A1'
        ]);

        $this->assertInstanceOf(Movie::class, $purchase->movie);
        $this->assertEquals($movie->id, $purchase->movie->id);
    }

    public function test_purchase_belongs_to_a_screening()
    {
        $movie = Movie::create([
            'title' => 'Test Movie',
            'description' => 'test description',
            'type' => 'action',
            'release_date' => '2020-01-01',
            'director' => 'Test Director',
            'duration_min' => 120,
            'poster_url' => 'test.jpg',
            'actors' => 'TestActor1, TestActor2'
        ]);

        $screening = Screening::create([
            'movie_id' => $movie->id,
            'drive_in_cinema_id' => 1,
            'start_time' => now(),
        ]);

        $purchase = Purchase::create([
            'screening_id' => $screening->id,
            'location_id' => 1,
            'movie_id' => $movie->id,
            'user_id' => 1,
            'ticket_code' => 'ABC123',
            'guest_email' => null,
            'parkingspot' => 'A1'
        ]);

        $this->assertInstanceOf(Screening::class, $purchase->screening);
        $this->assertEquals($screening->id, $purchase->screening->id);
    }

    public function test_purchase_belongs_to_a_user()
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'password' => "supersecretpass",
            "phone" => "06701234567"
        ]);

        $purchase = Purchase::create([
            'location_id' => 1,
            'screening_id' => 1,
            'movie_id' => 1,
            'ticket_code' => 'USER789',
            'guest_email' => null,
            'parkingspot' => 'C3',
            'user_id' => $user->id,
        ]);

        $this->assertInstanceOf(User::class, $purchase->user);
        $this->assertEquals($user->id, $purchase->user->id);
    }

    public function test_it_can_be_stored_in_database()
    {
        $purchase = Purchase::create([
            'location_id' => 1,
            'screening_id' => 1,
            'movie_id' => 1,
            'ticket_code' => 'SAVE123',
            'guest_email' => 'guest@example.com',
            'parkingspot' => 'D4',
            'user_id' => null,
        ]);

        $this->assertDatabaseHas('purchases', [
            'id' => $purchase->id,
            'ticket_code' => 'SAVE123',
            'guest_email' => 'guest@example.com',
            'parkingspot' => 'D4',
        ]);
    }
}