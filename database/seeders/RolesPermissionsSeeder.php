<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        $abilities = [
            'read',
            'write',
            'create',
            'delete',
        ];

        $permissions_by_role = [
            'super_admin' => [
                'user management',
                'appointment management',
                'doctor management',
                'service management',
                'gallery management',
                'blog management',
                'testimonial management',
                'setting management',
                'discount management',
                'expert tip management',
                'treatment option management',
                'contact message management',
            ],
            'admin' => [
                'appointment management',
                'doctor management',
                'service management',
                'gallery management',
                'blog management',
                'testimonial management',
                'contact message management',
            ],
            'administrator' => [
                'user management',
            ],
        ];

        // Create permissions
        foreach ($permissions_by_role as $permissions) {
            foreach ($permissions as $permission) {
                foreach ($abilities as $ability) {
                    $permissionName = $ability . ' ' . $permission;
                    if (!Permission::where('name', $permissionName)->exists()) {
                        Permission::create(['name' => $permissionName]);
                    }
                }
            }
        }

        // Create roles and sync permissions
        foreach ($permissions_by_role as $role => $permissions) {
            $full_permissions_list = [];
            foreach ($abilities as $ability) {
                foreach ($permissions as $permission) {
                    $full_permissions_list[] = $ability . ' ' . $permission;
                }
            }

            $roleInstance = Role::firstOrCreate(['name' => $role]);
            if (!empty($full_permissions_list)) {
                $roleInstance->syncPermissions($full_permissions_list);
            }
        }

        // Assign roles to users
        $superAdmin = User::where('email', 'superadmin@dental.com')->first();
        if ($superAdmin) {
            $superAdmin->assignRole('super_admin');
        }

        $admin = User::where('email', 'admin@dental.com')->first();
        if ($admin) {
            $admin->assignRole('admin');
        }

        // Keep demo user with administrator role for backward compatibility
        $demoUser = User::where('email', 'demo@demo.com')->first();
        if ($demoUser) {
            $demoUser->assignRole('administrator');
        }
    }
}
