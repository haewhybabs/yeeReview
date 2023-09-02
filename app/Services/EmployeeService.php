<?php
namespace App\Services;

use App\Repositories\EmployeeRepository;

class EmployeeService
{
    protected $employeeRepository;

    public function __construct(EmployeeRepository $EmployeeRepository)
    {
        $this->employeeRepository = $EmployeeRepository;
    }

    public function findAll(){
        return $this->employeeRepository->findAll();
    }

    public function create(array $attributes)
    {
        // Add business logic here, if necessary
        return $this->employeeRepository->create($attributes);
    }

    public function updateEmployee(array $attributes, $id)
    {
        // Add business logic here, if necessary
        return $this->employeeRepository->update($attributes,$id);
    }

    public function deleteEmployee($id)
    {
        // Add business logic here, if necessary
        return $this->employeeRepository->delete($id);
    }

    public function findByUserId($id){
        return $this->employeeRepository->findByUserId($id);
    }
    public function findByOrganisation($id){
        return $this->employeeRepository->findByOrganisationId($id);
    }

    public function findById($id){
        return $this->employeeRepository->findById($id);
    }
}
?>