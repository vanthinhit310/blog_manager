<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $owner = new \App\Role();
        $owner->name         = 'owner';
        $owner->display_name = 'App Owner';
        $owner->description  = 'User is the owner of a given project';
        $owner->save();

        $admin = new \App\Role();
        $admin->name         = 'admin';
        $admin->display_name = 'User Administrator';
        $admin->description  = 'User is allowed to manage and edit other users';
        $admin->save();

        $admin = new \App\Role();
        $admin->name         = 'user';
        $admin->display_name = 'User Standar';
        $admin->description  = 'Member account of application';
        $admin->save();

    }
}
