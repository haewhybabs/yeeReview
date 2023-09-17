<?php
namespace Database\Factories;
use App\Models\Goal;
use App\Models\Employee;
use App\Models\Organisation;
use App\Models\Quarter;
use Illuminate\Database\Eloquent\Factories\Factory;

class GoalFactory extends Factory
{
    protected $model = Goal::class;

    public function definition()
    {
        return [
            'employee_id' => 1,
            'organisation_id' => 1,
            'quarter_id' => 1,
            'description' => $this->faker->sentence,
            'status' => 'completed',
            'expected_days' => $this->faker->numberBetween(1, 30),
            'delivered_days' => $this->faker->numberBetween(1, 30),
            'completed_on_time' => $this->faker->boolean,
            'goal_name' => $this->faker->word,
            'year' => $this->faker->year,
            'weight' => $this->faker->randomFloat(2, 0, 100),
        ];
    }
}
