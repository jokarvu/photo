<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'admin',
            'description' => 'Administrator',
            'dashboard' => 'admin',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        for($i = 1; $i <= 45; $i++) {
            DB::table('permission_role')->insert([
                'role_id' => 1,
                'permission_id' => $i,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
