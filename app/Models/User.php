<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'type', 'email', 'phone', 'ssc_roll', 'ssc_regi', 'ssc_board', 'ssc_passing_year', 'ssc_gpa', 'ssc_out_of', 'hsc_roll', 'hsc_regi', 'hsc_board', 'hsc_passing_year', 'hsc_gpa', 'hsc_out_of', 'password', 'status', 'address_1', 'address_2', 'division_id', 'district_id', 'thana_id', 'email_verified_at', 'current_team_id', 'profile_photo_id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ['password', 'remember_token', 'two_factor_recovery_codes', 'two_factor_secret'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'dob' => 'date',
        'email_verified_at' => 'datetime',
    ];

    // Define the relationship with Role (Override)
    public function role()
    {
        return $this->belongsToMany(Role::class, 'user_roles');
    }
    // Define the relationship with Permissions
    public function allPermissions()
    {
        return $this->role->flatMap->permissions;
    }

    /**
     * Get all of the post for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function post()
    {
        return $this->hasMany(Post::class, 'user_id', 'id');
    }
}
