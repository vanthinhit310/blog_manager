<?php

namespace App\Console\Commands;

use App\User;
use Faker\Factory;
use Illuminate\Console\Command;

class Testcommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
//        Schema::disableForeignKeyConstraints();
//        Schema::enableForeignKeyConstraints();
        foreach (User::where('id','>',7855)->get()->chunk(100) as $users){
            foreach ($users as $user){
                $user->attachRole('user');
                dump($user->id);
            }
        }
    }
}
