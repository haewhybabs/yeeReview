<?php
namespace App\Services;

use App\Repositories\GoalRepository;

class GoalService
{
    protected $goalRepository;

    public function __construct(GoalRepository $goalRepository)
    {
        $this->goalRepository = $goalRepository;
    }

    public function create(array $attributes)
    {
        // Add business logic here, if necessary
        return $this->goalRepository->create($attributes);
    }

    public function updateGoal(array $attributes, $id)
    {
        // Add business logic here, if necessary
        return $this->goalRepository->update($attributes,$id);
    }

    public function deleteGoal($id)
    {
        // Add business logic here, if necessary
        return $this->goalRepository->delete($id);
    }

    public function findById($id){
        return $this->goalRepository->findById($id);
    }
    
    public function findAll(){
        return $this->goalRepository->findAll();
    }
    public function update($data,$id){
        return $this->goalRepository->update($data,$id);
    }
    public function findByStatus($status){
        return $this->goalRepository->findByStatus($status);
    }
    public function findByOrganisationId($organisationId){
        return $this->goalRepository->findByOrganisationId($organisationId);
    }

    public function findByEmployeeId($employeeId){
        return $this->goalRepository->findByEmployeeId($employeeId);
    }

    public function filterGoals($employeeId,$organisationId){
        return $this->goalRepository->filterGoals($employeeId,$organisationId);
    }

    public function fetchGoalByDetails($data){
        return $this->goalRepository->fetchGoalByDetails($data);
    }
    public function findByEmployeeIdAndStatus($id,$status){
        return $this->goalRepository->findByEmployeeIdAndStatus($id,$status);
    }
}
?>