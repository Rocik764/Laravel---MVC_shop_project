<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        DB::table('role_user')->truncate();

        $adminRole = Role::where('name', 'ADMIN')->first();
        $userRole = Role::where('name', 'USER')->first();
        $employeeRole = Role::where('name', 'EMPLOYEE')->first();

        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@mail.com',
            'password' => Hash::make('12345678')
        ]);

        $user = User::create([
            'name' => 'User',
            'email' => 'user@mail.com',
            'password' => Hash::make('12345678')
        ]);

        $employee = User::create([
            'name' => 'Employee User',
            'email' => 'employee@mail.com',
            'password' => Hash::make('12345678')
        ]);

        $admin -> roles()->attach($adminRole);
        $user -> roles()->attach($userRole);
        $employee -> roles()->attach($employeeRole);
    }
}
