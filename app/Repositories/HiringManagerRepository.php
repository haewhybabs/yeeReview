<?php
namespace App\Repositories;

use App\Models\HiringManager;

class HiringManagerRepository
{
    public function findAll()
    {
        return HiringManager::all();
    }
    public function findById($id)
    {
        return HiringManager::find($id);
    }

    public function findByUserId($id)
    {
        return HiringManager::where('user_id',$id)->first();
    }
    
    public function findByOrganisationId($organisationId){
        return HiringManager::where('organisation_id',$organisationId)->get();
    }
    public function create(array $data)
    {
        return HiringManager::create($data);
    }

    public function update(array $data, $id)
    {
        $hiringManager = HiringManager::findOrFail($id);
        $hiringManager->update($data);
        return $hiringManager;
    }

    public function delete($id)
    {
        $hiringManager = HiringManager::findOrFail($id);
        $hiringManager->delete();
        return true;
    }
}
?>