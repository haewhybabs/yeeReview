<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class PerformanceReviewTest extends TestCase
{
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::where('email', 'test@example.com')->firstOrFail();
    }

    public function testPerformanceReviewList()
    {
        $this->actingAs($this->user);

        $response = $this->get('/performance-reviews?employee_id=1&organisation_id=1&national_id=12345');

        $response->assertStatus(200);
        $response->assertViewIs('reviews.list');
    }
}
