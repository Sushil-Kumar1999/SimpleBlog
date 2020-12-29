<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $role1 = new Role();
        $role1->name = "User";
        $role1->save();

        $role2 = new Role();
        $role2->name = "Moderator";
        $role2->save();

        $role3 = new Role();
        $role3->name = "Administrator";
        $role3->save();
    }
}
