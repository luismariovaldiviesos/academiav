<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Luis Mario Valdivieso',
            'ci' => '0104649843',
            'phone' => '09873086688',
            'email' => 'admin@mail.com',
            'profile' => 'Admin',
            'status' => 'ACTIVE',
            'password' => bcrypt('administrador')
        ]);
        $user = User::create([
            'name' => 'Pedro  Castro',
            'ci' => '0104562178',
            'phone' => '0987256288',
            'email' => 'officer@mail.com',
            'profile' => 'Official',
            'status' => 'ACTIVE',
            'password' => bcrypt('officer')
        ]);


        $usuarios = User::all();
        foreach ($usuarios as $user) {
          if($user->profile === 'Admin')
          {
            $user->assignRole('Admin');
            $user->syncRoles('Admin');
          }

          elseif($user->profile === 'Official')
          {
            $user->assignRole('Official');
            $user->syncRoles('Official');
          }

        }
    }
}
