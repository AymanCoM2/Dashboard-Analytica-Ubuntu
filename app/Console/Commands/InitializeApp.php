<?php

namespace App\Console\Commands;

use App\Models\Dbase;
use App\Models\ReportCategory;
use App\Models\Role;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class InitializeApp extends Command
{
    protected $signature = 'app:initialize-app';
    // php artisan app:initialize-app

    protected $description = 'Initialize the App With Admin User And Basic Roles';

    public function handle()
    {
        // 1 - Making Roles  : 
        $adminRole = new Role();
        $adminRole->role_name = 'admin';
        $adminRole->save();
        $defaultRole = new Role();
        $defaultRole->role_name = 'Default Role';
        $defaultRole->save();

        // 2- Making the Admin User With the Role :
        $adminUser = new User();
        $adminUser->role_id = 1;
        $adminUser->name = 'admin';
        $adminUser->email = 'admin@admin.com';
        $adminUser->password = Hash::make('12345678');
        $adminUser->approved = true;
        $adminUser->email_verified_at = now();
        $adminUser->save();

        // 3- Making Default Category For any Query : 
        $defaultCategory  = new ReportCategory();
        $defaultCategory->category_name  = "Default Category";
        $defaultCategory->save();


        $dbLB = new Dbase();
        $dbLB->db_name  = 'LB';
        $dbLB->save();
        $dbTM = new Dbase();
        $dbTM->db_name  = 'TM';
        $dbTM->save();
    }
}
// Now Once the Command is Run the Category and the Defult Userrs are Ok with the ssytem  ; 
