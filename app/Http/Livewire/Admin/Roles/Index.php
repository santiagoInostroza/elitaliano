<?php

namespace App\Http\Livewire\Admin\Roles;


use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Index extends Component{

    public function render(){
        $roles = Role::all();
        $permissions = Permission::all();
        return view('livewire.admin.roles.index',compact('roles','permissions'));
    }

    public function createRole($nameRol, $permissions){
         if ($nameRol !="") {
            $role = Role::create([
               'name' => $nameRol 
            ]);
            $role->permissions()->sync($permissions);
         }
    }

    public function editName(Role $role, $newName){

        $role->name = $newName;
        $role->save();
    }
    public function editRole(Role $role, $permissions){

        $role->permissions()->sync($permissions);
    }

    public function deleteRole(Role $role){
        $role->delete();
    }
}
