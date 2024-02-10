<?php

namespace Database\Seeders;

use App\Repositories\UserRepository;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userRepository = new UserRepository();
        if ($userRepository->get([
            'email' => 'sahingul777@gmail.com'
        ])->first() === null){
            $userRepository->store([
                'name' => 'Şahin Gül',
                'email' => 'sahingul777@gmail.com',
                'hashed_id' => md5(time()),
                'password' => \Hash::make('na26072017**')
            ]);
        }
    }
}
