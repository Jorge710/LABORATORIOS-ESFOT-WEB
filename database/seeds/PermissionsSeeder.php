<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Users
        Permission::create([
            'name'          => 'Navegar usuarios',
            'slug'          => 'users.index',
            'description'   => 'Lista y navega todos los usuarios del sistema'
        ]);
        Permission::create([
            'name'          => 'Ver detalle de usuarios',
            'slug'          => 'users.show',
            'description'   => 'Ver en detalle cada usuario del sistema'
        ]);
        Permission::create([
            'name'          => 'Edición de usuarios',
            'slug'          => 'users.edit',
            'description'   => 'Editar cualquier dato de un usuario del sistema'
        ]);
        Permission::create([
            'name'          => 'Eliminar usuarios',
            'slug'          => 'users.destroy',
            'description'   => 'Elimina cualquier usuario del sistema'
        ]);
        //Roles
        Permission::create([
            'name'          => 'Navegar roles',
            'slug'          => 'roles.index',
            'description'   => 'Lista y navega todos los roles del sistema'
        ]);
        Permission::create([
            'name'          => 'Ver detalle de rol',
            'slug'          => 'roles.show',
            'description'   => 'Ver en detalle cada rol del sistema'
        ]);
        Permission::create([
            'name'          => 'Edición de roles',
            'slug'          => 'roles.create',
            'description'   => 'Crea cualquier dato de un rol del sistema'
        ]);
        Permission::create([
            'name'          => 'Edicion rol',
            'slug'          => 'roles.edit',
            'description'   => 'Edita cualquier rol del sistema'
        ]);
        Permission::create([
            'name'          => 'Eliminar rol',
            'slug'          => 'roles.destroy',
            'description'   => 'Elimina cualquier rol del sistema'
        ]);
    }
}
