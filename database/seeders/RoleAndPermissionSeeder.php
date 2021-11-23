<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Tạo vai trò
        $admin = Role::create(['name' => 'Admin']);

        // Gán vai trò
        User::find(1)->assignRole('Admin');

        // Tạo quyền
        $view_room = Permission::create(['name' => 'Xem danh sách phòng ban']);
        $create_room = Permission::create(['name' => 'Thêm phòng ban']);
        $edit_room = Permission::create(['name' => 'Chỉnh sửa phòng ban']);
        $delete_room = Permission::create(['name' => 'Xóa phòng ban']);

        // Set quyền cho vai trò admin
        $admin->givePermissionTo($view_room);
        $admin->givePermissionTo($create_room);
        $admin->givePermissionTo($edit_room);
        $admin->givePermissionTo($delete_room);

        $view_type = Permission::create(['name' => 'Xem danh sách loại dự án']);
        $create_type = Permission::create(['name' => 'Thêm loại dự án']);
        $edit_type = Permission::create(['name' => 'Chỉnh sửa loại dự án']);
        $delete_type = Permission::create(['name' => 'Xóa loại dự án']);

        $admin->givePermissionTo($view_type);
        $admin->givePermissionTo($create_type);
        $admin->givePermissionTo($edit_type);
        $admin->givePermissionTo($delete_type);

        $view_project = Permission::create(['name' => 'Xem danh sách dự án']);
        $create_project = Permission::create(['name' => 'Thêm dự án']);
        $edit_project = Permission::create(['name' => 'Chỉnh sửa dự án']);
        $delete_project = Permission::create(['name' => 'Xóa dự án']);

        $admin->givePermissionTo($view_project);
        $admin->givePermissionTo($create_project);
        $admin->givePermissionTo($edit_project);
        $admin->givePermissionTo($delete_project);

        $view_tech_stack = Permission::create(['name' => 'Xem danh sách công nghệ']);
        $create_tech_stack = Permission::create(['name' => 'Thêm công nghệ']);
        $edit_tech_stack = Permission::create(['name' => 'Chỉnh sửa công nghệ']);
        $delete_tech_stack = Permission::create(['name' => 'Xóa công nghệ']);

        $admin->givePermissionTo($view_tech_stack);
        $admin->givePermissionTo($create_tech_stack);
        $admin->givePermissionTo($edit_tech_stack);
        $admin->givePermissionTo($delete_tech_stack);

        $view_customer = Permission::create(['name' => 'Xem danh sách khách hàng']);
        $create_customer = Permission::create(['name' => 'Thêm khách hàng']);
        $edit_customer = Permission::create(['name' => 'Chỉnh sửa khách hàng']);
        $delete_customer = Permission::create(['name' => 'Xóa khách hàng']);

        $admin->givePermissionTo($view_customer);
        $admin->givePermissionTo($create_customer);
        $admin->givePermissionTo($edit_customer);
        $admin->givePermissionTo($delete_customer);

        $view_user = Permission::create(['name' => 'Xem danh sách nhân sự']);
        $create_user = Permission::create(['name' => 'Thêm nhân sự']);
        $edit_user = Permission::create(['name' => 'Chỉnh sửa nhân sự']);
        $delete_user = Permission::create(['name' => 'Xóa nhân sự']);

        $admin->givePermissionTo($view_user);
        $admin->givePermissionTo($create_user);
        $admin->givePermissionTo($edit_user);
        $admin->givePermissionTo($delete_user);

        $view_role = Permission::create(['name' => 'Xem danh sách vai trò']);
        $create_role = Permission::create(['name' => 'Thêm vai trò']);
        $edit_role = Permission::create(['name' => 'Chỉnh sửa vai trò']);
        $delete_role = Permission::create(['name' => 'Xóa vai trò']);

        $admin->givePermissionTo($view_role);
        $admin->givePermissionTo($create_role);
        $admin->givePermissionTo($edit_role);
        $admin->givePermissionTo($delete_role);

        $view_permission = Permission::create(['name' => 'Xem danh sách quyền']);
        $view_permission_detail = Permission::create(['name' => 'Xem quyền']);
        $edit_permission = Permission::create(['name' => 'Chỉnh sửa quyền']);

        $admin->givePermissionTo($view_permission);
        $admin->givePermissionTo($view_permission_detail);
        $admin->givePermissionTo($edit_permission);
    }
}
