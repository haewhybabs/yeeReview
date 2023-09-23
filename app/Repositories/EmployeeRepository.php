<?php
namespace App\Repositories;

use App\Models\Employee;

class EmployeeRepository
{
    public function findAll()
    {
        return Employee::all();
    }
    public function findById($id)
    {
        return Employee::find($id);
    }

    public function findByUserId($id)
    {
        return Employee::where('user_id',$id)->first();
    }
    
    public function findByOrganisationId($organisationId){
        return Employee::where('current_organisation_id',$organisationId)->get();
    }
    public function findByNationalId($nationalId){
        return Employee::where('national_id',$nationalId)->get();
    }
    public function create(array $data)
    {
        return Employee::create($data);
    }

    public function update(array $data, $id)
    {
        $employee = Employee::findOrFail($id);
        $employee->update($data);
        return $employee;
    }

    public function delete($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();
        return true;
    }
    
}
?>