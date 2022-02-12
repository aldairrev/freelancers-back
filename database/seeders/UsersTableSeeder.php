<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@freelancers.pe',
            'password' => \Illuminate\Support\Facades\Hash::make('1234')
        ])->assignRole('Admin');

        User::create([
            'name' => 'Freelancer',
            'email' => 'freelancer@freelancers.pe',
            'password' => \Illuminate\Support\Facades\Hash::make('1234')
        ])->assignRole('Freelancer');

        User::create([
            'name' => 'Contractor',
            'email' => 'contractor@freelancer.pe',
            'password' => \Illuminate\Support\Facades\Hash::make('1234')
        ])->assignRole('Contractor');
        
        User::create([
            'name' => 'Journalist',
            'email' => 'journalist@freelancer.pe',
            'password' => \Illuminate\Support\Facades\Hash::make('1234')
        ])->assignRole('Journalist');
    }
}
