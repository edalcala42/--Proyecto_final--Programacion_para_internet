<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = Role::where('nombre', 'Administrador')->first();
        $role_blogger = Role::where('nombre', 'Blogger')->first();
        $role_cliente = Role::where('nombre', 'Cliente')->first();

        $user = new User();
        $user->name = "Admin1";
        $user->email = "admin1@test.com";
        $user->password = bcrypt('query');
        $user->save();
        $user->roles()->attach($role_admin);
        

        $user = new User();
        $user->name = "Blogger1";
        $user->email = "blogger1@test.com";
        $user->password = bcrypt('query');
        $user->save();
        $user->roles()->attach($role_blogger);
        

        $user = new User();
        $user->name = "Cliente1";
        $user->email = "cliente1@test.com";
        $user->password = bcrypt('query');
        $user->save();
        $user->roles()->attach($role_cliente);
    }
}
