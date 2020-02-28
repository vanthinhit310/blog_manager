<?php

use Illuminate\Database\Seeder;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $owner = \App\Role::whereName('owner')->first();
        $spadm  = new \App\User();
        $spadm->firstName = 'Admin';
        $spadm->lastName = 'Super';
        $spadm->email = 'superadmin@app.com';
        $spadm->password = \Illuminate\Support\Facades\Hash::make('Abc@1234');
        $spadm->mobile = '0982650542';
        $spadm->register_at = \Illuminate\Support\Carbon::now();
        $spadm->remember_token = \Illuminate\Support\Str::random(40);
        $spadm->save();
        $spadm->attachRole($owner);
    }
}
