<?php
namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function findAll()
    {
        return User::all();
    }
    public function findById($id)
    {
        return User::find($id);
    }
    public function findAllByRoleId($roleId){
        return User::where('role_id',$roleId)->get();
    }
    public function findByEmail($email){
        return User::where('email',$email)->first();
    }
    public function create(array $data)
    {
        return User::create($data);
    }

    public function update(array $data, $id)
    {
        $user = User::findOrFail($id);
        $user->update($data);
        return $user;
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return true;
    }
}
?>