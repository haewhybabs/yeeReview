<?php
namespace App\Repositories;

use App\Models\Organisation;

class OrganisationRepository
{
    public function findAll()
    {
        return Organisation::all();
    }
    public function findById($id)
    {
        return Organisation::find($id);
    }
    
    public function findByEmail($email){
        return Organisation::where('email',$email)->first();
    }
    public function create(array $data)
    {
        return Organisation::create($data);
    }

    public function update(array $data, $id)
    {
        $organisation = Organisation::findOrFail($id);
        $organisation->update($data);
        return $organisation;
    }

    public function delete($id)
    {
        $organisation = Organisation::findOrFail($id);
        $organisation->delete();
        return true;
    }
    public function findByStatus($status){
        return Organisation::where('status',$status)->get();
    }
    
}
?>