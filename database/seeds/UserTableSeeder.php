<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_employee = Role::where('name', 'visitor')->first();
        $role_manager  = Role::where('name', 'admin')->first();
        $employee = new User();
        $employee->name = 'Visitor2';
        $employee->email = 'visitor2@example.com';
        $employee->password = bcrypt('secret');
        $employee->save();
        $employee->roles()->attach($role_employee);

        $manager = new User();
        $manager->name = 'Admin2';
        $manager->email = 'admin1@example.com';
        $manager->password = bcrypt('secret');
        $manager->save();
        $manager->roles()->attach($role_manager);
    }
}
