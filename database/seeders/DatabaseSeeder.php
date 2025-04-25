<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        /* $this->call([RoleSeeder::class]);
        
        User::create([
            'name' => 'GERENTE PROPIETARIO',
            'email' => 'sistemafermin@gmail.com',
            'password' => Hash::make('fermin12345?'),
            'estado' => '1',
            'codigo_credencial' => 'FACE01',
            //'id_role' => 1,
        ]);
        User::create([
            'name' => 'TRABAJADOR',
            'email' => 'trabajador@gmail.com',
            'password' => Hash::make('fermin12345?'),
            'estado' => '1',

        ]); */

        $this->call([
            //UsersTableSeeder::class,
            RoleSeeder::class,
        ]);
    }
}
