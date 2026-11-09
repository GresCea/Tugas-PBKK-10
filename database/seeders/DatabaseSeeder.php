<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $adminRole = Role::firstOrCreate(['name' => 'Admin', 'guard_name' => 'web']);
        $stafRole = Role::firstOrCreate(['name' => 'Staf', 'guard_name' => 'web']);
        $viewProjects = Permission::firstOrCreate(['name' => 'projects.view', 'guard_name' => 'web']);
        $deleteProjects = Permission::firstOrCreate(['name' => 'projects.delete', 'guard_name' => 'web']);
        $adminRole->syncPermissions([$viewProjects, $deleteProjects]);
        $stafRole->syncPermissions([$viewProjects]);

        $admin = User::factory()->create([
            'name' => 'Admin PBKK',
            'email' => 'adminpbkk@its.ac.id',
            'password' => Hash::make('password'), // hashed cast makes this idempotent
        ]);
        $admin->syncRoles([$adminRole]);

        $staf = User::factory()->create([
            'name' => 'Staf PBKK',
            'email' => 'stafpbkk@its.ac.id',
            'password' => Hash::make('password'),
        ]);
        $staf->syncRoles([$stafRole]);

        Project::factory()
            ->count(5)
            ->for($admin)
            ->create([
                'judul' => 'Agentic AI Portfolio Assistant for ITS Students',
            ]);

        User::factory()
            ->count(15)
            ->itsStudent()
            ->has(Project::factory()->count(2))
            ->create();
    }
}
