<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Roles
        $superAdmin = Role::create(['id' => 1, 'name' => 'Super-Admin']);
        $branchAdmin = Role::create(['id' => 2, 'name' => 'Branch-Admin']);
        $doctor = Role::create(['id' => 3, 'name' => 'Doctor']);
        $receptionist = Role::create(['id' => 4, 'name' => 'Receptionist']);

        //CRUD Branch Admin
        $createBranch = Permission::create(['name' => 'Create-Branch']);
        $viewBranch = Permission::create(['name' => 'View-Branch']);
        $editBranch = Permission::create(['name' => 'Edit-Branch']);
        $deleteBranch = Permission::create(['name' => 'Delete-Branch']);

        //CRUD Branch Admin
        $createBranchAdmin = Permission::create(['name' => 'Create-Branch-Admin']);
        $viewBranchAdmin = Permission::create(['name' => 'View-Branch-Admin']);
        $editBranchAdmin = Permission::create(['name' => 'Edit-Branch-Admin']);
        $deleteBranchAdmin = Permission::create(['name' => 'Delete-Branch-Admin']);

        //CRUD Doctors
        $createDoctor = Permission::create(['name' => 'Create-Doctor']);
        $viewDoctor = Permission::create(['name' => 'View-Doctor']);
        $editDoctor = Permission::create(['name' => 'Edit-Doctor']);
        $deleteDoctor = Permission::create(['name' => 'Delete-Doctor']);

        //CRUD Receptionist
        $createReceptionist = Permission::create(['name' => 'Create-Receptionist']);
        $viewReceptionist = Permission::create(['name' => 'View-Receptionist']);
        $editReceptionist = Permission::create(['name' => 'Edit-Receptionist']);
        $deleteReceptionist = Permission::create(['name' => 'Delete-Receptionist']);

        //CRUD Pattients
        $createPattient = Permission::create(['name' => 'Create-Pattient']);
        $viewPattient = Permission::create(['name' => 'View-Pattient']);
        $editPattient = Permission::create(['name' => 'Edit-Pattient']);
        $deletePattient = Permission::create(['name' => 'Delete-Pattient']);

        //Other Permissions
        $generateReport = Permission::create(['name' => 'Generate-report']);
        $accessPattient = Permission::create(['name' => 'Access-Pattient']);
        $setting = Permission::create(['name' => 'Setting']);

        //Give superAdmin all permissions
        $superAdmin->syncPermissions(Permission::all());

        //Give BranchAdmin Permissions
        $branchAdmin->givePermissionTo
        ([
            $createDoctor,
            $viewDoctor,
            $editDoctor,
            $deleteDoctor,

            $createReceptionist,
            $viewReceptionist,
            $editReceptionist,
            $deleteReceptionist,

            $createPattient,
            $viewPattient,
            $editPattient,
            $deletePattient,

            $generateReport,
            $accessPattient,
        ]);

        //Give Doctor Permissions
        $doctor->givePermissionTo
        ([

            $createPattient,
            $viewPattient,
            $editPattient,
            $deletePattient,

            $generateReport,
            $accessPattient,
        ]);

        //Give Receptionist Permissions
        $receptionist->givePermissionTo
        ([

            $createPattient,
            $viewPattient,
            $editPattient,
            $deletePattient,
        ]);


    }
}
