<?php
namespace App\Services;

use App\Repositories\EmployeeRepository;
use App\Repositories\OrganisationRepository;

class OrganisationService
{
    protected $organisationRepository;
    protected $employeeRepository;

    public function __construct(OrganisationRepository $organisationRepository,EmployeeRepository $employeeRepository)
    {
        $this->organisationRepository = $organisationRepository;
        $this->employeeRepository = $employeeRepository;
    }

    public function create(array $attributes)
    {
        // Add business logic here, if necessary
        return $this->organisationRepository->create($attributes);
    }

    public function updateorganisation(array $attributes, $id)
    {
        // Add business logic here, if necessary
        return $this->organisationRepository->update($attributes,$id);
    }

    public function deleteorganisation($id)
    {
        // Add business logic here, if necessary
        return $this->organisationRepository->delete($id);
    }

    public function findByEmail($email){
        return $this->organisationRepository->findByEmail($email);
    }
    public function findById($id){
        return $this->organisationRepository->findById($id);
    }
    
    public function findAll(){
        return $this->organisationRepository->findAll();
    }
    public function update($data,$id){
        return $this->organisationRepository->update($data,$id);
    }
    public function findByStatus($status){
        return $this->organisationRepository->findByStatus($status);
    }
    public function findByNationalId($nationalId){
        $employees = $this->employeeRepository->findByNationalId($nationalId);
        $organisations = [];
        foreach($employees as $e){
            $organisations[] = $this->findById($e->current_organisation_id);
        }
        return $organisations;
    }
   
}
?>