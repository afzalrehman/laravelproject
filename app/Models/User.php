<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Request;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

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

    static public function getRecord($request)
    {
        $return = self::select('users.*')->orderBy('id', 'DESC');
        //Search Start 
        if (!empty(Request::get('id'))) {
            $return->where('users.id', '=', Request::get('id'));
        }
        if (!empty(Request::get('name'))) {
            $return->where('users.name', 'like', '%' . Request::get('name') . '%');
        }
        if (!empty(Request::get('username'))) {
            $return->where('users.username', 'like', '%' . Request::get('username') . '%');
        }
        if (!empty(Request::get('email'))) {
            $return->where('users.email', 'like', '%' . Request::get('email') . '%');
        }
        if (!empty(Request::get('phone'))) {
            $return->where('users.phone', 'like', '%' . Request::get('phone') . '%');
        }
        if (!empty(Request::get('webiste'))) {
            $return->where('users.webiste', 'like', '%' . Request::get('webiste') . '%');
        }

        if (!empty(Request::get('role'))) {
            $return->where('users.role', '=', Request::get('role'));
        }

        if (!empty(Request::get('status'))) {
            $return->where('users.status', '=', Request::get('status'));
        }
        if (!empty(Request::get('start_Date') && !empty(Request::get('end_Date')))) {
            $return->where('users.created_at', '>=', Request::get('start_Date'))->where('users.created_at', '<=', Request::get('end_Date'));
        }
        // if (!empty(Request::get('start_Date') && !empty(Request::get('end_Date')))) {
        //     $return->where('users.created_at', '<=', Request::get('created_at'));
        // }


        //Search End
        $return = $return->paginate(10);
        return $return;
    }
}
