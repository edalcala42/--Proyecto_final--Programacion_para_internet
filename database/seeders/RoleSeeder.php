<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'nombre'=>'Administrador'
        ]);
        Role::create([
            'nombre'=>'Blogger'
        ]);
        Role::create([
            'nombre'=>'Cliente'
        ]);
    }
}
