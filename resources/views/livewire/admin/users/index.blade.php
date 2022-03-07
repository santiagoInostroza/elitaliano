<section class="w-full">
    <div class="w-full mx-auto bg-white shadow-lg rounded-sm  border-gray-200 ">
        <div class="p-4">
            <x-jet-input class="w-full h-12 border-gray-200 shadow px-2" placeholder="Ingresa nombre de usuario a buscar..." wire:model.debounce.1000ms="search"></x-jet-input>
        </div>
     
        <div class="p-3 w-full ">
            @if ($users->count())
                <div class="overflow-auto  w-full m-auto">
                    <table class="overflow-auto  table-auto w-full ">
                        <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                            <tr>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Id</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Nombre</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Email</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Rol</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left"></div>
                                </th>                            
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-100">
                            @foreach ($users as $user)
                            <tr>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-lg text-center">{{$user->id}}</div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 flex-shrink-0 mr-2 sm:mr-3"><img class="rounded-full" src="https://raw.githubusercontent.com/cruip/vuejs-admin-dashboard-template/main/src/images/user-36-05.jpg" width="40" height="40" alt="Alex Shatov"></div>
                                        <div class="font-medium text-gray-800">{{$user->name}}</div>
                                    </div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-left">{{$user->email}}</div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="flex gap-x-4 items-center" x-data="{roles:[ {{ implode(",", ($user->roles->pluck('id'))->toArray()) }} ], user:{{$user->id}} }"  >
                                        <div class="text-left">
                                            @foreach ($user->roles as $role)
                                                <div>{{$role->name}}</div>
                                            @endforeach
                                        </div>
                                        <x-modal.screen>
                                            <div class="cursor-pointer hover:bg-gray-200 p-2 rounded">
                                                <i class="fas fa-pen"></i>
                                            </div>
                                            <x-slot name="header">Modificar roles a {{$user->name}}</x-slot>
                                            <x-slot name="body">       
                                                @foreach ($roles as $role)
                                                    <label class="flex gap-4 items-center p-4 hover:bg-gray-200 cursor-pointer" for="{{$user->id}}_{{$role->id}}">
                                                        <input type="checkbox" value="{{$role->id}}" x-model="roles" id="{{$user->id}}_{{$role->id}}">
                                                        <div>{{$role->name}}</div>
                                                    </label>
                                                @endforeach                                                
                                            </x-slot>
                                            <x-slot name="footer">
                                                <x-jet-button x-on:click="$wire.editRoles(user,roles).then( ()=> {show = !show;}) ">Realizar cambios</x-jet-button>
                                            </x-slot>
                                        </x-modal.screen>
                                    </div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    {{-- <div class="text-left"><x-jet-button>Editar</x-jet-button></div> --}}
                                </td>
                            </tr>  
                            @endforeach
                                                
                        </tbody>
                    </table>
                </div>
            @else
                <div class="p-4"> No hay registros...</div>
            @endif
        </div>
    </div>




</section>
