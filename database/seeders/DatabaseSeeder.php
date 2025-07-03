<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();


        Role::create(['name' => 'super_admin', 'guard_name' => 'web']);
        Role::create(['name' => 'Admin', 'guard_name' => 'web']);
        User::create([
            'name' => 'Test User',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password')
        ])->assignRole('super_admin');

        User::create([
            'name' => 'Test User',
            'email' => 'administrador@gmail.com',
            'password' => Hash::make('password')
        ])->assignRole('Admin');

        User::create([
            'name' => 'Test User 2',
            'email' => 'test2@gmail.com',
            'password' => Hash::make('password')
        ]);

        $this->call(AreaConocimiento::class);
        $this->call(DivisionDepartamentoSeeder::class);
        $this->call(ShieldSeeder::class);
    }
}
