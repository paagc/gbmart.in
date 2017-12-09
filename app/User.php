<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    // use Notifiable;
    use EntrustUserTrait, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type', 'name', 'email', 'password', 'mobile_number', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    public function addresses()
    {
        return $this->hasMany('App\Address', 'user_id');
    }

    public function orders()
    {
        return $this->hasMany('App\Order', 'customer_id');
    }

    public function wishlist()
    {
        return $this->hasMany('App\Wishlist', 'customer_id');
    }

    public function seller_products()
    {
        return $this->hasMany('App\SellerProduct', 'seller_id');
    }

    public function sendPasswordResetNotification($token)
    {
        $email = $this->email;
        $username = $this->name;
        \Mail::send('auth.emails.password', compact('token', 'email'), function ($message) use ($username, $email) {
            $message->to($email, $username)->subject('Reset Password');
        });
    }
}
