<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrator PSC',
            'email' => 'adminpsc@nganjukkab.go.id',
            'password' => Hash::make('adminpscnganjuk321#@!'),
            'email_verified_at' => now(),
        ]);
    }
}