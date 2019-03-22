<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            'name' => 'list-permission',
            'description' => 'User can list permissions',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'name' => 'add-permission',
            'description' => 'User can add new permissions',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
