<div class="relative">
   <div class="absolute right-0 top-0 -mt-10">
      <div class="flex justify-end " x-data="{nameRole:'',permissions:[],loading:false}">
      <x-modal.screen>
         <x-jet-button>Nuevo</x-jet-button>   
         <x-slot name="header"> Crear nuevo rol</x-slot>  
         <x-slot name="body">
           
            <x-jet-input x-model="nameRole" required placeholder="Ingrese el nombre del rol" class="p-4 w-full"></x-jet-input>
            <span x-show="nameRole.length == 0" class="text-red-600 p-2">Debes ingresar un nombre para el rol</span>
            <ul class="my-4">
               @foreach ($permissions as $permission)
                  <li>
                     <label> 
                        <div class="p-2 flex gap-4 items-center cursor-pointer hover:bg-gray-200 w-full">
                           <input type="checkbox" x-model="permissions" value="{{$permission->id}}">
                           {{$permission->description}}
                        </div>
                     </label>
                  </li>
               @endforeach
            </ul>
            <div x-html="nameRole"></div>
            <div x-html="permissions"></div>
         </x-slot>
         <x-slot name="footer">
            <div class="flex items-center gap-4">
               <x-jet-button x-on:click="loading=true;$wire.createRole(nameRole,permissions).then( ()=>{show=false;loading=false})" x-bind:disabled="(loading  || nameRole.length == 0 )? true:false">Crear</x-jet-button>
               <div x-show="loading">
                  cargando...
               </div>
            </div>                 
         </x-slot>
         
      </x-modal.screen> 
   </div>   
   </div>
   
   <x-table.table>

      <x-slot name="thead">
         <tr>
            <x-table.th>Id</x-table.th>
            <x-table.th> Nombre</x-table.th>
            <x-table.th width="10"> </x-table.th>
         </tr>
      </x-slot>
      <x-slot name="tbody">
         @foreach ($roles as $role)
            <tr>
               <x-table.td> {{$role->id}}</x-table.td>
               <x-table.td> 
                  <div class="flex justify-between items-center gap-4 mr-4 hover:bg-gray-200 p-4">
                     
                     <div>{{$role->name}}</div>
                     <div id="edit_role_{{$role->id}}" x-data="{name:'{{$role->name}}',newName:'',permissions:[ {{ implode(",", ($role->permissions->pluck('id'))->toArray()) }} ]}">
                        <x-modal.alert>
                           <x-jet-secondary-button x-on:click=""><i class="fas fa-pen"></i> </x-jet-secondary-button>
                           <x-slot name="header">Editar nombre de rol</x-slot>
                           <x-slot name="body">
                              <div class="p-4">
                              Nombre actual: <span x-html="name"></span>
                              </div>
                              <div>
                                 <x-jet-input x-model="newName" class="p-4 w-full" placeholder="Ingresa nuevo nombre"></x-jet-input>
                              </div>
                           </x-slot>
                           <x-slot name="footer">
                              <x-jet-button x-on:click="$wire.editName({{$role}},newName).then( ()=>{show=false})" x-bind:disabled=" newName.length == 0 ? true:false">Cambiar Nombre</x-jet-button>
                           </x-slot>
                        </x-modal.screen>
                     </div>
                     
                  </div>
               </x-table.td>
               <x-table.td width="10"> 
                  <div class="flex items-center gap-4">
                     <div>
                        <ul>
                           @foreach ($role->permissions as $permission)
                               <li>
                                  {{$permission->description}}
                               </li>
                           @endforeach
                        </ul>
                     </div>
                     <div id="edit_role_{{$role->id}}" x-data="{name:'{{$role->name}}',newName:'',permissions:[ {{ implode(",", ($role->permissions->pluck('id'))->toArray()) }} ]}">
                        <x-modal.screen>
                           <x-jet-button x-on:click="">Editar</x-jet-button>
                           <x-slot name="header">Editar Rol {{$role->name}} </x-slot>
                           <x-slot name="body">
                              <ul class="my-4">
                                 @foreach ($permissions as $permission)
                                    <li>
                                       <label> 
                                          <div class="p-2 flex gap-4 items-center cursor-pointer hover:bg-gray-200 w-full">
                                             <input type="checkbox" x-model="permissions" value="{{$permission->id}}">
                                             {{$permission->description}}
                                          </div>
                                       </label>
                                    </li>
                                 @endforeach
                              </ul>
                           </x-slot>



                           <x-slot name="footer">
                              <x-jet-button x-on:click="$wire.editRole({{$role}},permissions).then( ()=>{show=false})" >Editar Rol</x-jet-button>
                           </x-slot>
                        </x-modal.screen>
                     </div>
                     <div x-data  id="delete_role_{{$role->id}}" >
                        <x-modal.alert>
                           <x-jet-danger-button>Eliminar</x-jet-danger-button>
                           <x-slot name="header">ELiminar Rol {{$role->name}}</x-slot>
                           <x-slot name="body">Seguro deseas eliminar este rol?</x-slot>
                           <x-slot name="footer"><x-jet-danger-button x-on:click="$wire.deleteRole({{$role}}).then( ()=>{show=false})">Eliminar Rol</x-jet-danger-button></x-slot>
                        </x-modal.screen>
                     </div>
                     
                  </div>
      
               </x-table.td>
            </tr>
         @endforeach
      </x-slot>
   </x-table.table>
</div>
