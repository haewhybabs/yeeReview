<?php

namespace Tests\Feature;

use App\Models\Employee;
use App\Models\Goal;
use App\Models\Organisation;
use App\Models\Quarter;
use App\Models\User;
use App\Services\EmployeeService;
use App\Services\GoalService;
use App\Services\OrganisationService;
use App\Services\UserService;
use Database\Seeders\TestSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GoalControllerTest extends TestCase
{
    protected $user;
    public function testListMethodDisplaysCreateGoals()
    {
        // Create a test user
        $this->seed(TestSeeder::class);
         $this->user = User::factory()->create([
            'email' => 'test@example.com',
            'first_name'=>'first name 2',
            'last_name'=>'last_name 2',
            'role_id'=>env("ADMIN_ROLE"),

        ]);
        
        $this->actingAs($this->user);
        Goal::factory()->create([
            'description' => 'Goal 1 Description',
            'goal_name' => 'Goal 1',
        ]);

        Goal::factory()->create([
            'description' => 'Goal 2 Description',
            'goal_name' => 'Goal 2',
        ]);

        $response = $this->get('/goals');

        $response->assertStatus(200); 
        $response->assertSee('Goal 1 Description');
        $response->assertSee('Goal 2 Description');
        $response->assertSee('Goal 1');
        $response->assertSee('Goal 2');
    }

    public function testGoalList()
    {
         // Create a test user
        $this->user = User::where('email', 'test@example.com')->firstOrFail();
        $this->actingAs($this->user);
        // Create test data in the database
        $employee = 1;
        $quarter =1;
        $organisation = 1;
        $goal = Goal::factory()->create([
            'employee_id' => $employee,
            'quarter_id' => $quarter,
            'organisation_id' => $organisation
        ]);

        
        $response = $this->get('/goals');

        
        $response->assertStatus(200);

        
        $response->assertSee($goal->description); 
    }
}
