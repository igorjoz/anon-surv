<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 45; $i++) {
            User::factory()
                ->create()
                ->assignRole('user');
        }

        User::factory()->create([
            'email' => 'admin@igorjozefowicz.com',
            'password' => Hash::make(config('app.admin_password', 'adminpassword')),
        ])->assignRole('admin');

        User::factory()->create([
            'email' => 'user@igorjozefowicz.com',
            'password' => Hash::make(config('app.user_password', 'userpassword')),
        ])->assignRole('user');
    }
}
