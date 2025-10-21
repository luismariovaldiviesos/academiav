<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         //roles
         Role::create(['name'=>'Admin']);
         Role::create(['name'=>'Official']);

         //clientes
            Permission::create(['name' => 'crear_cliente',
            'guard_name' => 'web',
            ]);
            Permission::create([
                'name' => 'ver_cliente',
                'guard_name' => 'web',
            ]);
            Permission::create([
                'name' => 'buscar_cliente',
                'guard_name' => 'web',
            ]);
            Permission::create([
                'name' => 'editar_cliente',
                'guard_name' => 'web',
            ]);
            Permission::create([
                'name' => 'eliminar_cliente',
                'guard_name' => 'web',
            ]);

            Permission::create([
                'name' => 'configuracion',
                'guard_name' => 'web',
            ]);
            Permission::create([
                'name' => 'reportes',
                'guard_name' => 'web',
            ]);

    }
}
