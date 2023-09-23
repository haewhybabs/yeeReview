<?php
namespace App\Services;

use App\Repositories\GoalRepository;
use App\Repositories\PerformanceReviewRepository;

class PerformanceReviewService
{
    protected $performanceReviewRepository;
    protected $goalRepository;

    public function __construct(PerformanceReviewRepository $performanceReviewRepository,GoalRepository $goalRepository)
    {
        $this->performanceReviewRepository = $performanceReviewRepository;
        $this->goalRepository = $goalRepository;
    }

    public function create(array $attributes)
    {
        // Add business logic here, if necessary
        return $this->performanceReviewRepository->create($attributes);
    }

    public function updatePerformanceReview(array $attributes, $id)
    {
        // Add business logic here, if necessary
        return $this->performanceReviewRepository->update($attributes,$id);
    }

    public function deletePerformanceReview($id)
    {
        // Add business logic here, if necessary
        return $this->performanceReviewRepository->delete($id);
    }

    public function findById($id){
        return $this->performanceReviewRepository->findById($id);
    }
    
    public function findAll(){
        return $this->performanceReviewRepository->findAll();
    }
    public function update($data,$id){
        return $this->performanceReviewRepository->update($data,$id);
    }
    public function findByOrganisationId($organisationId){
        return $this->performanceReviewRepository->findByOrganisationId($organisationId);
    }

    public function findByEmployeeId($employeeId){
        return $this->performanceReviewRepository->findByEmployeeId($employeeId);
    }

    public function filterPerformanceReviews($employeeId,$organisationId,$nationalId){
        return $this->performanceReviewRepository->filterPerformanceReviews($employeeId,$organisationId,$nationalId);
    }
    public function calculatePerformanceScore($data){
        $goals = $this->goalRepository->getEmployeeGoals($data);
        $totalScore = 0; 

        foreach ($goals as $goal) {
            $achievementStatusScore = $goal->status=='completed' ? 100 : 0;
            $daysDifference = $goal->delivered_days - $goal->expected_days;
            $earlyCompletionThreshold = -7; // Completed 7 or more days early
            $onTimeThreshold = 0; // Completed on or before the expected day
            $delayedThreshold = 7; // Completed within 7 days after the expected day
    
            if ($daysDifference <= $earlyCompletionThreshold) {
                $timelinessScore = 100; // Completed well ahead of schedule
            } elseif ($daysDifference <= $onTimeThreshold) {
                $timelinessScore = 80; // Completed on time or slightly early
            } elseif ($daysDifference <= $delayedThreshold) {
                $timelinessScore = 50; // Slightly delayed but within an acceptable range
            } else {
                $timelinessScore = 0; // Significantly delayed
            }
    
           
            $weightedScore = (($achievementStatusScore + $timelinessScore) / 2 ) + $goal->weight;
    
            $totalScore += $weightedScore;
        }
        $count = count($goals);
        $totalScore = $count >0 ? $totalScore/count($goals): 0;

        $totalScore = min($totalScore, 100);
    
        return $totalScore;

    }
    public function fetchReviewByDetails($data){
        return $this->performanceReviewRepository->fetchReviewByDetails($data);
    }
}
?>