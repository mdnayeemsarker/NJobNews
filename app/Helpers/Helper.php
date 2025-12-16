<?php

use App\Models\User;
use App\Models\Upload;
use App\Helpers\FileHelper;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Repositories\Interfaces\FileUploadRepositoryInterface;

/**
 * Check if it is admin or not
 */
if (!function_exists('is_admin')) {
    function is_admin()
    {
        return Auth::check() && Auth::user()->type == 'admin';
    }
}

if (!function_exists('get_client_type')) {
    /**
     * Get Client type
     */
    function get_client_type()
    {
        return request()->attributes->get('clientType');
    }
}

if (!function_exists('get_token_type')) {
    /**
     * Get Client type
     */
    function get_token_type()
    {
        return request()->attributes->get('token_type');
    }
}

if (!function_exists('get_random_otp')) {
    /**
     * get random number
     *
     * @param $length
     */
    function get_random_otp($length)
    {
        return substr(str_shuffle(str_repeat(get_setting('random_number'), 5)), 0, $length);
    }
}
if (!function_exists('get_random_text')) {
    /**
     * get random number
     *
     * @param $length
     */
    function get_random_text($length)
    {
        return substr(str_shuffle(str_repeat(get_setting('random_text'), 5)), 0, $length);
    }
}
if (!function_exists('get_setting')) {
    /**
     * Get setting value by key
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    function get_setting($key, $default = null)
    {
        return app(SettingRepositoryInterface::class)->getSetting($key, $default);
    }
}
if (!function_exists('get_file_url')) {
    /**
     * Get the URL of the uploaded file.
     *
     * @param  string $filePath
     * @return string File URL
     */
    function get_file_url($filePath)
    {
        $upload = Upload::find($filePath);
        if ($upload) {
            return app(FileUploadRepositoryInterface::class)->getFileUrl($upload->file_path);
        }
    }
}

/**
 * Upload a file using the helper function and return metadata.
 *
 * @param \Illuminate\Http\UploadedFile $file
 * @param string $directory
 * @param string|null $fileName
 * @return array File metadata
 */
if (!function_exists('upload_file')) {
    function upload_file($file, $type, $is_public)
    {
        $fileMeta = FileHelper::uploadFile($file);

        $upload = new Upload();
        $upload->type = $type;
        $upload->file_path = $fileMeta['file_path'];
        $upload->file_name = $fileMeta['file_name'];
        $upload->original_name = $fileMeta['original_name'];
        $upload->extension = $fileMeta['extension'];
        $upload->size = $fileMeta['size'];
        $upload->mime_type = $fileMeta['mime_type'];
        $upload->file_type = $fileMeta['file_type'];
        $upload->is_public = $is_public;
        $upload->save();

        return $upload->id;
    }
}

/**
 * Upload a file using the helper function and return metadata.
 *
 * @param \Illuminate\Http\UploadedFile $file
 * @param string $directory
 * @param string|null $fileName
 * @return array File metadata
 */
if (!function_exists('delete_file')) {
    function delete_file($file)
    {
        $deleteFile = FileHelper::deleteFile($file);
        if ($deleteFile) {
            return true;
        } else {
            return false;
        }
    }
}
if (!function_exists('generateUniqueSlug')) {
    /**
     * Generate a unique slug for a model.
     *
     * @param string $name The base name to generate the slug from.
     * @param string $modelClass The fully qualified class name of the model.
     * @param string $slugColumn The name of the column to check for uniqueness (default: 'slug').
     * @return string The unique slug.
     */
    function generateUniqueSlug($name, $modelClass, $slugColumn = 'slug')
    {
        $slug = Str::slug($name);
        $count = app($modelClass)
            ::where($slugColumn, 'like', "{$slug}%")
            ->count();
        return $count > 0 ? "{$slug}-{$count}" : $slug;
    }
}

if (!function_exists('flush_data')) {
    /**
     * Make session flush data by using param
     *
     * @param string $type
     * @param string $title
     * @param string $message
     */
    function flush_data($type, $title, $message)
    {
        session()->flash($type, ['title' => $title, 'message' => $message]);
    }
}
if (!function_exists('hasPermission')) {
    /**
     * Check if the authenticated user has a specific permission.
     *
     * @param  string  $permission
     * @return bool
     */
    function hasPermission($permissionName)
    {
        $user = User::find(Auth::id());
        if ($user->type === 'admin') {
            return true;
        }
        if ($user && $user->role()->exists()) {
            $permissions = $user->allPermissions();
            return $permissions->contains('name', $permissionName);
        }
        return false;
    }
}
