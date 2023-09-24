<?php
namespace App\Repositories;

use App\Models\Goal;

class GoalRepository
{
    public function findAll()
    {
        return Goal::all();
    }
    public function findById($id)
    {
        return Goal::find($id);
    }
    
    public function create(array $data)
    {
        return Goal::create($data);
    }

    public function update(array $data, $id)
    {
        $goal = Goal::findOrFail($id);
        $goal->update($data);
        return $goal;
    }

    public function delete($id)
    {
        $goal = Goal::findOrFail($id);
        $goal->delete();
        return true;
    }
    public function findByStatus($status){
        return Goal::where('status',$status)->get();
    }

    public function findByOrganisationId($organisationId){
        return Goal::where('organisation_id',$organisationId)->get();
    }
    public function findByEmployeeId($employeeId){
        return Goal::where('employee_id',$employeeId)->get();
    }

    public function filterGoals($employeeId,$organisationId){
        $query = Goal::query();

        if($employeeId){
            $query->where('employee_id',$employeeId);
        }

        if($organisationId){
            $query->where('organisation_id',$organisationId);
        }

        $goals = $query->get();

        return $goals;

    }

    public function getEmployeeGoals($data){
        $goals = Goal::where('employee_id', $data['employee_id'])
                 ->where('organisation_id', $data['organisation_id'])
                 ->where('year', $data['year'])
                 ->where('quarter_id', $data['quarter_id'])
                 ->get();
        return $goals;
    }
    public function fetchGoalByDetails($data){
        $goal = Goal::where('employee_id', $data['employee_id'])
        ->where('organisation_id', $data['organisation_id'])
        ->where('year', $data['year'])
        ->where('quarter_id', $data['quarter_id'])
        ->first();
        return $goal;
    }
    public function findByEmployeeIdAndStatus($id,$status){
        return Goal::where('status','completed')->where('employee_id',$id)->get();
    }
}
?>