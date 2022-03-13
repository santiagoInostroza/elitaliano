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

       $purchases = Permission::create(['name' => 'admin.purchases.index', 'description'=>'Ver lista de Compras']);
       $createPurchase = Permission::create(['name' => 'admin.purchases.create', 'description'=>'Crear compra']);
       $showPurchase = Permission::create(['name' => 'admin.purchases.show', 'description'=>'Ver Compra']);
       $editPurchase = Permission::create(['name' => 'admin.purchases.edit', 'description'=>'Editar compra']);
       $destroyPurchase = Permission::create(['name' => 'admin.purchases.destroy', 'description'=>'ELiminar compra']);

       $sales = Permission::create(['name' => 'admin.sales.index', 'description'=>'Ver lista de Ventas']);
       $editSale = Permission::create(['name' => 'admin.sales.edit', 'description'=>'Editar Venta']);
       $showSale = Permission::create(['name' => 'admin.sales.show', 'description'=>'Ver Venta']);
       $createSale = Permission::create(['name' => 'admin.sales.create', 'description'=>'Crear Venta']);
       $destroySale = Permission::create(['name' => 'admin.sales.destroy', 'description'=>'Eliminar Venta']);

       $categories = Permission::create(['name' => 'admin.categories.index', 'description'=>'Ver lista de Categorias']);
       $editCategory = Permission::create(['name' => 'admin.categories.edit', 'description'=>'Editar Categoria']);
       $showCategory = Permission::create(['name' => 'admin.categories.show', 'description'=>'Ver Categoria']);
       $createCategory = Permission::create(['name' => 'admin.categories.create', 'description'=>'Crear Categoria']);
       $destroyCategory = Permission::create(['name' => 'admin.categories.destroy', 'description'=>'Eliminar Categoria']);

       $p6 = Permission::create(['name' => 'all', 'description'=>' Ver Todo']);
       $p7 = Permission::create(['name' => 'admin.products', 'description'=>' Ver Productos']);
       $p8 = Permission::create(['name' => 'admin.dashboard', 'description'=>' Ver Dashboard']);
       $p9 = Permission::create(['name' => 'admin.suppliers', 'description'=>' Ver Proveedores']);
       $p10 = Permission::create(['name' => 'admin.customers', 'description'=>' Ver Clientes']);

       

       $superAdmin =  Role::create(['name' => 'Super Admin']);
       $admin =  Role::create(['name' => 'Admin']);
       $vendedor =  Role::create(['name' => 'Vendedor']);

       $superAdmin->syncPermissions([
           $panel,$p2,$p3,
           $purchases,$createPurchase,$showPurchase,$editPurchase, $destroyPurchase,
           $sales,$editSale,$showSale,$createSale, $destroySale,
           $categories,$editCategory,$showCategory,$createCategory, $destroyCategory,
           $p6,$p7,$p8,$p9,$p10,
        ]);
       $admin->syncPermissions([
           $panel,$p2,$p3,
           $purchases,$createPurchase,$showPurchase,$editPurchase, $destroyPurchase,
           $sales,$editSale,$showSale,$createSale, $destroySale,
           $categories,$editCategory,$showCategory,$createCategory, $destroyCategory,
           $p6,$p7,$p8,$p9,$p10,
        ]);
       $vendedor->syncPermissions([
            $panel, 
            $purchases,$createPurchase,$showPurchase,$editPurchase, 
            $sales,$editSale,$showSale,$createSale
        ]);

       


    }
}
