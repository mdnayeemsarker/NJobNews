<?php
namespace App\Helpers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
class PermissionHelper
{
    /**
     * Check if the authenticated user has a specific permission.
     *
     * @param  string  $permission
     * @return bool
     */
    public static function hasPermission($permissionName)
    {
        $user = User::find(Auth::id());
        if ($user && $user->role()->exists()) {
            $permissions = $user->allPermissions();
            return $permissions->contains('name', $permissionName);
        }
        return false;
    }
}