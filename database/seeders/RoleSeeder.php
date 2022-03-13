<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
       

       $panel = Permission::create(['name' => 'admin', 'description'=>'Ver Panel administrativo']);
       $p2 = Permission::create(['name' => 'admin.users', 'description'=>'Ver Usuarios']);
       $p3 = Permission::create(['name' => 'admin.roles', 'description'=>'Ver Roles']);

       $purchaseIndex = Permission::create(['name' => 'admin.purchases.index', 'description'=>'Ver Compras']);
       $purchaseCreate = Permission::create(['name' => 'admin.purchases.create', 'description'=>'Crear compra']);
       $purchaseShow = Permission::create(['name' => 'admin.purchases.show', 'description'=>'Ver Compra']);
       $purchaseEdit = Permission::create(['name' => 'admin.purchases.edit', 'description'=>'Editar compra']);

       $sales = Permission::create(['name' => 'admin.sales.index', 'description'=>'Ver Ventas']);
       $editSale = Permission::create(['name' => 'admin.sales.edit', 'description'=>'Editar Ventas']);
       $showSale = Permission::create(['name' => 'admin.sales.show', 'description'=>'Ver Ventas']);
       $createSale = Permission::create(['name' => 'admin.sales.create', 'description'=>'Crear Ventas']);

       $p6 = Permission::create(['name' => 'all', 'description'=>' Ver Todo']);
       $p7 = Permission::create(['name' => 'admin.products', 'description'=>' Ver Productos']);
       $p8 = Permission::create(['name' => 'admin.dashboard', 'description'=>' Ver Dashboard']);
       $p9 = Permission::create(['name' => 'admin.suppliers', 'description'=>' Ver Proveedores']);
       $p10 = Permission::create(['name' => 'admin.customers', 'description'=>' Ver Clientes']);

       $admin =  Role::create(['name' => 'Admin']);
       $vendedor =  Role::create(['name' => 'Vendedor']);

       $admin->syncPermissions([$panel,$p2,$p3,$purchaseIndex,$purchaseCreate,$purchaseShow,$purchaseEdit,$p6,$p7,$p8,$p9,$p10,$sales,$editSale,$showSale,$createSale]);
       $vendedor->syncPermissions([$panel, $purchaseIndex,$purchaseCreate,$purchaseShow,$purchaseEdit,$sales,$p6,$sales,$editSale,$showSale,$createSale]);

       


    }
}
