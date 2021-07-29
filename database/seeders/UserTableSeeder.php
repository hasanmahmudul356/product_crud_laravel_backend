<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'Super user';
        $user->email = 'superuser@gmail.com';
        $user->phone = '01700000000';
        $user->password = '123456';
        $user->save();

        echo "Product Seed Complete \n";
    }
}
