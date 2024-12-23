<?php
namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $sa_role = Role::create(['name' => 'Super-Admin']);
        $ad_role = Role::create(['name' => 'Admin']);
        $or_role = Role::create(['name' => 'Originator']);
        Role::create(['name' => 'Manager']);
        $as_role = Role::create(['name' => 'Assistant']);
        Role::create(['name' => 'Accountant']);
        Role::create(['name' => 'Teacher']);
        Role::create(['name' => 'Student']);
        Role::create(['name' => 'JobSeeker']);
        Role::create(['name' => 'Examiner']);
        Role::create(['name' => 'NewComer']);
        Role::create(['name' => 'Marketer']);
        Role::create(['name' => 'QuestionMaker']);
        Role::create(['name' => 'QuestionAuditor']);

        $user = User::create(['user_name' => 'Yasser.Bishesari', 'password' => '403Institute$#', 'created' => j_d_stamp_en()]);
        $user->assignRole($sa_role);

        $user = User::create(['user_name' => 'N.Bakhshi', 'password' => 'Institute$#', 'created' => j_d_stamp_en()]);
        $user->assignRole($or_role);

        $user = User::create(['user_name' => 'M.Moosavi', 'password' => 'Institute$#', 'created' => j_d_stamp_en()]);
        $user->assignRole($as_role);
    }
}
