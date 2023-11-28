<?php

namespace Database\Seeders;

use App\Models\Status_Users;
use App\Models\StatusUsers;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $status_users = ['Hoạt động','Bị khóa'];
        foreach ($status_users as $name) {
            StatusUsers::create(['name' => $name]);
        }
    }
}
