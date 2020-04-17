<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call('RoleTableSeeder');

        $this->command->info('Role table seeded!');
    }

  
    
}

class RoleTableSeeder extends Seeder {

    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'show orders']);
        Permission::create(['name' => 'manage custumers']);
        Permission::create(['name' => 'manage clients']);
        Permission::create(['name' => 'manage orders']);
        Permission::create(['name' => 'manage drivers']);
        Permission::create(['name' => 'manage employee']);
        Permission::create(['name' => 'manage configs']);


        $agent = Role::create(['name' => 'agent'])
        ->givePermissionTo(['show orders']);

        $admin = Role::create(['name' => 'super_admin'])
        ->givePermissionTo(['show orders'] , ['manage custumers'] ,
    ['manage clients'] , ['manage orders'] , ['manage drivers' ],['manage employee'] ,['manage configs']);

    $employee = Role::create(['name' => 'employee'])
    ->givePermissionTo(['show orders'] , ['manage custumers'] ,
['manage clients'] , ['manage orders'] , ['manage drivers']);
    }
}