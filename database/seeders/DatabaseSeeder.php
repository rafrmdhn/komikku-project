<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Komik;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $categories = [
            'Action', 'Fantasy', 'Mystery', 'Comedy'
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate([
                'name' => $category,
            ]);
        }

        // Komik::factory(20)->create();

        Role::firstOrCreate(['name' => 'Admin']);
        Role::firstOrcreate(['name' => 'Customer']);

        // $user = User::create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('qweasdzxc'),
        // ]);

        $user = User::where('email', 'test@example.com')->first();

        $user->assignRole('Admin');
    }
}
