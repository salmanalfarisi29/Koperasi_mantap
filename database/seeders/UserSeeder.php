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
    $users = [
      [
        'name' => 'Admin',
        'username' => 'admin',
        'email' => 'admin@example.com',
        'password' => Hash::make('123456'),
        'role' => 'admin',
      ],
      [
        'name' => 'Petugas',
        'username' => 'petugas',
        'email' => 'petugas@example.com',
        'password' => Hash::make('123456'),
        'role' => 'petugas',
      ],
    ];

    foreach ($users as $user) {
      User::create($user);
    }
  }
}
