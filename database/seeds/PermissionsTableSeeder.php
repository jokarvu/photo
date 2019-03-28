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
        // Permission
        DB::table('permissions')->insert([
            'name' => 'list-permission',
            'description' => 'User can list permission',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'name' => 'add-permission',
            'description' => 'User can add new permission',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'name' => 'edit-permission',
            'description' => 'User can edit permission',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'name' => 'remove-permission',
            'description' => 'User can delete permission',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'name' => 'view-permission',
            'description' => 'User can view permission',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        // Role
        DB::table('permissions')->insert([
            'name' => 'list-role',
            'description' => 'User can list role',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'name' => 'add-role',
            'description' => 'User can add new role',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'name' => 'edit-role',
            'description' => 'User can edit role',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'name' => 'remove-role',
            'description' => 'User can delete role',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'name' => 'view-role',
            'description' => 'User can view role',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        // User
        DB::table('permissions')->insert([
            'name' => 'list-user',
            'description' => 'User can list user',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'name' => 'add-user',
            'description' => 'User can add new user',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'name' => 'edit-user',
            'description' => 'User can edit user',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'name' => 'remove-user',
            'description' => 'User can delete user',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'name' => 'view-user',
            'description' => 'User can view user',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        // Tag
        DB::table('permissions')->insert([
            'name' => 'list-tag',
            'description' => 'User can list tag',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'name' => 'add-tag',
            'description' => 'User can add new tag',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'name' => 'edit-tag',
            'description' => 'User can edit tag',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'name' => 'remove-tag',
            'description' => 'User can delete tag',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'name' => 'view-tag',
            'description' => 'User can view tag',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        // album
        DB::table('permissions')->insert([
            'name' => 'list-album',
            'description' => 'User can list album',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'name' => 'add-album',
            'description' => 'User can add new album',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'name' => 'edit-album',
            'description' => 'User can edit album',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'name' => 'remove-album',
            'description' => 'User can delete album',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'name' => 'view-album',
            'description' => 'User can view album',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        // image
        DB::table('permissions')->insert([
            'name' => 'list-image',
            'description' => 'User can list image',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'name' => 'add-image',
            'description' => 'User can add new image',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'name' => 'edit-image',
            'description' => 'User can edit image',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'name' => 'remove-image',
            'description' => 'User can delete image',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'name' => 'view-image',
            'description' => 'User can view image',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        // option
        DB::table('permissions')->insert([
            'name' => 'list-option',
            'description' => 'User can list option',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'name' => 'add-option',
            'description' => 'User can add new option',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'name' => 'edit-option',
            'description' => 'User can edit option',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'name' => 'remove-option',
            'description' => 'User can delete option',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'name' => 'view-option',
            'description' => 'User can view option',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        // Coupon
        DB::table('permissions')->insert([
            'name' => 'list-coupon',
            'description' => 'User can list coupon',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'name' => 'add-coupon',
            'description' => 'User can add new coupon',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'name' => 'edit-coupon',
            'description' => 'User can edit coupon',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'name' => 'remove-coupon',
            'description' => 'User can delete coupon',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'name' => 'view-coupon',
            'description' => 'User can view coupon',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        // Location
        DB::table('permissions')->insert([
            'name' => 'list-location',
            'description' => 'User can list location',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'name' => 'add-location',
            'description' => 'User can add new location',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'name' => 'edit-location',
            'description' => 'User can edit location',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'name' => 'remove-location',
            'description' => 'User can delete location',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('permissions')->insert([
            'name' => 'view-location',
            'description' => 'User can view location',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
