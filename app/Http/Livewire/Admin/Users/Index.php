<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Index extends Component{
    public $search;

    public function render(){
        $users = User::where('name','like','%'. $this->search . '%')->orWhere('email','like','%'. $this->search . '%')->get();
        $roles = Role::all();
        return view('livewire.admin.users.index',compact('users','roles'));
    }

    public function editRoles(User $user, $roles){
        $user->syncRoles($roles);
    }
}
