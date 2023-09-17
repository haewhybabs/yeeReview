<?php
namespace App\Services;

use App\Repositories\RecruitmentRepository;

class RecruitmentService
{
    protected $recruitmentRepository;

    public function __construct(RecruitmentRepository $recruitmentRepository)
    {
        $this->recruitmentRepository = $recruitmentRepository;
    }

    public function create(array $attributes)
    {
        // Add business logic here, if necessary
        return $this->recruitmentRepository->create($attributes);
    }

    public function updateRecruitment(array $attributes, $id)
    {
        // Add business logic here, if necessary
        return $this->recruitmentRepository->update($attributes,$id);
    }

    public function deleteRecruitment($id)
    {
        // Add business logic here, if necessary
        return $this->recruitmentRepository->delete($id);
    }

    public function findNationalId($id){
        return $this->recruitmentRepository->findByNationalId($id);
    }

    public function findById($id){
        return $this->recruitmentRepository->findById($id);
    }

    public function findAll(){
        return $this->recruitmentRepository->findAll();
    }

    public function findByOrganisation($id){
        return $this->recruitmentRepository->findByOrganisationId($id);
    }

}
?>