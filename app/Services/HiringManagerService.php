<?php
namespace App\Services;

use App\Repositories\HiringManagerRepository;

class HiringManagerService
{
    protected $hiringManagerRepository;

    public function __construct(HiringManagerRepository $HiringManagerRepository)
    {
        $this->hiringManagerRepository = $HiringManagerRepository;
    }

    public function create(array $attributes)
    {
        // Add business logic here, if necessary
        return $this->hiringManagerRepository->create($attributes);
    }

    public function updateHiringManager(array $attributes, $id)
    {
        // Add business logic here, if necessary
        return $this->hiringManagerRepository->update($attributes,$id);
    }

    public function deleteHiringManager($id)
    {
        // Add business logic here, if necessary
        return $this->hiringManagerRepository->delete($id);
    }

    public function findByUserId($id){
        return $this->hiringManagerRepository->findByUserId($id);
    }
    public function findByOrganisation($id){
        return $this->hiringManagerRepository->findByOrganisationId($id);
    }

    public function findById($id){
        return $this->hiringManagerRepository->findById($id);
    }
}
?>