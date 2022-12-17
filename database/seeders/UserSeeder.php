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
        'name' => 'Admin 1',
        'username' => 'admin1',
        'email' => 'admin1@example.com',
        'password' => Hash::make('123456'),
        'role' => 'admin',
      ],
      [
        'name' => 'Admin 2',
        'username' => 'admin2',
        'email' => 'admin2@example.com',
        'password' => Hash::make('123456'),
        'role' => 'admin',
      ],
    ];

    foreach ($users as $user) {
      User::create($user);
    }
  }
}
