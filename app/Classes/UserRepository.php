<?php


namespace App\Classes;


use App\Permission;
use App\Role;
use App\RolePermission;
use App\User;
use App\UserRole;

class UserRepository
{
    public static function getAllPermissions(User $user)
    {
        $userRole = new UserRole();
        return self::GetQuery()
            ->where($userRole->qualifyColumn('user_id'), '=', $user->id)
            ->get();
    }

    public static function attachPermissions($users, $attributeName = 'allPermissions')
    {
        $permission = new Permission();
        $userRole = new UserRole();
        $heap = self::GetQuery()
            ->select(
                $userRole->qualifyColumn('user_id'),
                $permission->qualifyColumn('text_id'),
                $permission->qualifyColumn('name')
            )
            ->whereIn($userRole->qualifyColumn('user_id'), $users->pluck('id'))
            ->get();

        foreach ($users as $user) {
            $user->{$attributeName} = collect();
            foreach ($heap as $permissionExtended) {
                if ($user->id == $permissionExtended->user_id) {
                    $user->{$attributeName}->push($permissionExtended);
                }
            }
        }
    }

    private static function GetQuery()
    {
        $permission = new Permission();
        $rolePermission = new RolePermission();
        $role = new Role();
        $userRole = new UserRole();

        return Permission::select($permission->qualifyColumn('text_id'), $permission->qualifyColumn('name'))
            ->distinct()
            ->join(
                $rolePermission->getTable(),
                $permission->qualifyColumn('text_id'),
                '=',
                $rolePermission->qualifyColumn('permission_text_id')
            )
            ->join($role->getTable(), $rolePermission->qualifyColumn('role_id'), '=', $role->qualifyColumn('id'))
            ->join($userRole->getTable(), $role->qualifyColumn('id'), '=', $userRole->qualifyColumn('role_id'))
            ->orderBy($permission->qualifyColumn('name'));
    }
}
