<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function routeNotificationForFcm()
    {
        return [
            'dN39KIvvCLAASfoZNXg1n8:APA91bHvdKCfRyhHbWgAn-IpeLG0_poWnIgTEttu0OCJpQAKe4VkV0ULBfwCE3GqzgT4nst0jKHicmurpQJ3BihtZ294_MPblYrfpqNlgTR321XW9iRd4ShTi0Z1HOsNEh3cfiEKwl2m',
            'dVya0Q01wXqTJImXzhK-_h:APA91bG-1HcJpWzvB04h652zMLLqlM3hkFFxeJhLtUEuOXRDD5sj20L0DxuPVMObSpueAJEdgCUZ93rKyz87UYFB8tXbNNhnDLK_eeBEloNJBrK1um3nY5HME4PeIHTKIA_DD94qXNr2', // punya kak dhar
        ];
    }
}
