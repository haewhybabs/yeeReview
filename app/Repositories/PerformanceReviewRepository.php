<?php
namespace App\Repositories;

use App\Models\PerformanceReview;

class PerformanceReviewRepository
{
    public function findAll()
    {
        return PerformanceReview::all();
    }
    public function findById($id)
    {
        return PerformanceReview::find($id);
    }
    
    public function create(array $data)
    {
        return PerformanceReview::create($data);
    }

    public function update(array $data, $id)
    {
        $performanceReview = PerformanceReview::findOrFail($id);
        $performanceReview->update($data);
        return $performanceReview;
    }

    public function delete($id)
    {
        $performanceReview = PerformanceReview::findOrFail($id);
        $performanceReview->delete();
        return true;
    }


    public function findByOrganisationId($organisationId){
        return PerformanceReview::where('organisation_id',$organisationId)->get();
    }
    public function findByEmployeeId($employeeId){
        return PerformanceReview::where('employee',$employeeId)->get();
    }

    public function filterPerformanceReviews($employeeId,$organisationId,$nationalId){
        $query = PerformanceReview::query();

        if($employeeId){
            $query->where('employee_id',$employeeId);
        }

        if($organisationId){
            $query->where('organisation_id',$organisationId);
        }
        
        $performanceReviews = $query->get();
        if($nationalId){
            $performanceReviews = PerformanceReview::where('national_id',$nationalId)->get();
        }

        return $performanceReviews;

    }
    public function fetchReviewByDetails($data){
        $goal = PerformanceReview::where('employee_id', $data['employee_id'])
        ->where('organisation_id', $data['organisation_id'])
        ->where('year', $data['year'])
        ->where('quarter_id', $data['quarter_id'])
        ->first();
        return $goal;
    }
}
?>