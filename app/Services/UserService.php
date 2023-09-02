<?php
namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function create(array $attributes)
    {
        // Add business logic here, if necessary
        return $this->userRepository->create($attributes);
    }

    public function updateUser(array $attributes, $id)
    {
        // Add business logic here, if necessary
        return $this->userRepository->update($attributes,$id);
    }

    public function deleteUser($id)
    {
        // Add business logic here, if necessary
        return $this->userRepository->delete($id);
    }

    public function findByEmail($email){
        return $this->userRepository->findByEmail($email);
    }
    public function findAllByRoleId($roleId){
        return $this->userRepository->findAllByRoleId($roleId);
    }

    public function findById($id){
        return $this->userRepository->findById($id);
    }

    public function createUserOthers($request,$role){
        $register = $request->validate([
            'password' => 'required|min:8|confirmed',
            'email'=>'required|email|unique:users',
            'first_name'=>'required',
            'last_name'=>'required',
        ]);
        $register['role_id']=$role;
        $register['password']=bcrypt($request->password);

        return $this->create($register);
    }
}
?>