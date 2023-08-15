<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserRoleManualSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 3; $i <= 621; $i++) {
            $user = User::find($i);
            if($user->user_type == 'Individual'){
                $user->assignRole('investor');
            }else{
                $user->assignRole('issuer');
            }
            //$userData[$i] = 'Individual';
        }
    }
}
