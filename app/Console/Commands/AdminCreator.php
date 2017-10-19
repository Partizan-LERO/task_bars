<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class AdminCreator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:admin {name} {email} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create user as admin';

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
        $name = $this->argument('name');
        $email = $this->argument('email');
        $password = bcrypt($this->argument('password'));

        DB::table('users')->insert([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'isAdmin' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $this->info('The user has been created successfully!');
    }
}
