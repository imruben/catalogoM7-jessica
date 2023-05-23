<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name'=> "admin",
            'email'=> "admin@admin.com",
            'password'=> Hash::make('123456789'),
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
        User::factory(20)->create();
    }
}
