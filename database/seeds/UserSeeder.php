<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $limit = 50000;

        for ($i = 0; $i < $limit; $i++) {
            DB::table('users')->insert([
                'firstName' => $faker->firstName,
                'lastName' => $faker->lastName,
                'email' => $faker->unique()->email,
                'mobile' => $faker->unique()->tollFreePhoneNumber,
                'register_at' => $faker->date($format = 'Y-m-d', $max = 'now').' '.$faker->time($format = 'H:i:s', $max = 'now'),
                'avatar' => $faker->imageUrl(400, 200),
                'last_login' => $faker->date($format = 'Y-m-d', $max = 'now').' '.$faker->time($format = 'H:i:s', $max = 'now'),
                'password' => bcrypt('Abc@1234'),
                'intro' => $faker->sentence($nbWords = 50, $variableNbWords = true),
                'profile' => $faker->realText($maxNbChars = 800, $indexSize = 2)
            ]);
        }
    }
}
