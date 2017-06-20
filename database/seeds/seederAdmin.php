<?php

use Illuminate\Database\Seeder;

class seederAdmin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	'name' => 'AdminRRH',
        	'email' => 'admin@admin.com',
        	'password' => '$2y$10$k6V0R4VuVigDKqD.iphjNeBCiY4C/P08ukdYdB7XLA7nagsG/4Chy',
        	'usertype' => 0,
        	]);
    }
}
