<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'name' => 'Admin',
            'deskripsi' => "user admin"
        ]);
        Role::create([
            'name' => 'Kader',
            'deskripsi' => "user kader posyandu"
        ]);
        Role::create([
            'name' => 'Staff',
            'deskripsi' => "user staff desa"
        ]);
        Role::create([
            'name' => 'Masyarakat',
            'deskripsi' => "user masyarakat"
        ]);
    }
}
