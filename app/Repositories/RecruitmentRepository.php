<?php
namespace App\Repositories;

use App\Models\Recruitment;

class RecruitmentRepository
{
    public function findAll()
    {
        return Recruitment::all();
    }
    public function findById($id)
    {
        return Recruitment::find($id);
    }

    public function findByNationalId($id){
        return Recruitment::where('national_id',$id)->get();
    }
    public function create(array $data)
    {
        return Recruitment::create($data);
    }

    public function update(array $data, $id)
    {
        $recruitment = Recruitment::findOrFail($id);
        $recruitment->update($data);
        return $recruitment;
    }

    public function delete($id)
    {
        $recruitment = Recruitment::findOrFail($id);
        $recruitment->delete();
        return true;
    }
    public function findByOrganisationId($organisationId){
        return Recruitment::where('organisation_id',$organisationId)->get();
    }
    public function filterRecruitments($nationalId,$organisationId){
        $query = Recruitment::query();

        if($nationalId){
            $query->where('national_id',$nationalId);
        }

        if($organisationId){
            $query->where('organisation_id',$organisationId);
        }

        $recruitments = $query->get();

        return $recruitments;
    }
}
?>