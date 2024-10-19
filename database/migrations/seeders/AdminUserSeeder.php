<?php

namespace Database\Seeders;
use App\Models\Member;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Member::create(['name'=>'adminuser','email'=>'admin@admin.com','phone_number'=>'9898986421','age'=>45,'role'=>1,'subscription_over'=>"2030-12-12 00:00:00"]);
    }
}
