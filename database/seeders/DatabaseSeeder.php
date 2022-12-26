<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $administrador = User::factory()->create([
            'name'=>'admin',
            'email'=>'admin@admin.com',
            'password' => bcrypt('12345678')
        ]);
        $administrador1 = User::factory()->create([
            'name'=>'admin1',
            'email'=>'admin1@admin.com',
            'password' => bcrypt('12345678')
        ]);
        $administrador2 = User::factory()->create([
            'name'=>'admin2',
            'email'=>'admin2@admin.com',
            'password' => bcrypt('12345678')
        ]);
        $administrador3 = User::factory()->create([
            'name'=>'admin3',
            'email'=>'admin3@admin.com',
            'password' => bcrypt('12345678')
        ]);
        $administrador4 = User::factory()->create([
            'name'=>'admin4',
            'email'=>'admin4@admin.com',
            'password' => bcrypt('12345678')
        ]);

        $admin = Role::create(['name'=>'administrador']);

        // CRUD 
        $permissions = [
            'create',
            'read',
            'update',
            'delete',
        ];

        foreach(Role::all() as $rol){
            foreach($permissions as $p){
                if($rol->name == 'administrador') $rol->name = 'usuario';
                Permission::create(['name' => "{$rol->name} $p"]);
            }
        }       

        $admin->syncPermissions(Permission::all());

        $administrador->assignRole('administrador');
        $administrador1->assignRole('administrador');
        $administrador2->assignRole('administrador');
        $administrador3->assignRole('administrador');
        $administrador4->assignRole('administrador');
    }
}
