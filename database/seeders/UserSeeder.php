<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;




class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name'=>'admin']);
        Role::create(['name'=>'employe']);
        Role::create(['name'=>'client']);
        Role::create(['name'=>'partenaire']);

         $user=User::create([
        'name'=>'Samir',
        'email'=>'samirlabodja@gmail.com',
        'password'=>hash::make( value:'Sam1234' )

         ]);

         $roleAdmin=Role::findByName('admin','web');
         $roleClient=Role::findByName('client','web');

        $user->assignRole([$roleAdmin]);

         // Admin Permission
         Permission::create(['name' => 'view dashboard']);
        Permission::create(['name' => 'manageUsers']);
        Permission::create(['name' => 'updateUser']);
        Permission::create(['name' => 'manageDocument']);
        Permission::create(['name' => 'aprroveDocument']);
        Permission::create(['name' => 'rejectDocument']);
        Permission::create(['name' => 'manageDossiers']);
        Permission::create(['name' => 'updateDossierStatus']);
        Permission::create(['name' => 'sendNotification']);
        Permission::create(['name' => 'viewStatistics']);

        //Client Permission
        Permission::create(['name' => 'userProfile']);
        Permission::create(['name' => 'updateProfile']);
        Permission::create(['name' => 'uploadDocument']);
        Permission::create(['name' => 'viewDocuments']);
        Permission::create(['name' => 'viewDossiers']);
        Permission::create(['name' => 'createSupportTicket']);
        Permission::create(['name' => 'viewSupportTickets']);



        // Ajoutez d'autres permissions selon vos besoins

         // Roles pour les administrateurs
        $roleAdmin->givePermissionTo('manageUsers');
        $roleAdmin->givePermissionTo('updateUser');
        $roleAdmin->givePermissionTo('manageDocument');
        $roleAdmin->givePermissionTo('aprroveDocument');
        $roleAdmin->givePermissionTo('rejectDocument');
        $roleAdmin->givePermissionTo('manageDossiers');
        $roleAdmin->givePermissionTo('updateDossierStatus');
        $roleAdmin->givePermissionTo('sendNotification');
        $roleAdmin->givePermissionTo('viewStatistics');

        // Roles pour les clients

        $roleClient->givePermissionTO(['userProfile', 'updateProfile', 'uploadDocument',
        'viewDocuments', 'viewDossiers', 'createSupportTicket', 'viewSupportTickets']);



        // Assignez des permissions aux autres rôles




    }
}
