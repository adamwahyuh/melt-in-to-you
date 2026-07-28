<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Address;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Appends;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'username'])]
#[Hidden(['password', 'remember_token'])]
#[Appends(['initials'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

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

    public function peran(){
        return $this->belongsToMany(Peran::class, 'peran_users', 'user_id', 'peran_id')
                ->withPivot(['name'])
                ->withTimestamps();
    }

    public function cup(){
        return $this->hasOne(Cup::class, 'user_id');
    }

    public function orders(){
        return $this->hasMany(Order::class, 'user_id');
    }
    
    public function getInitialsAttribute(){
        $name = trim($this->name);
        $words = explode(' ', $name);

        if(count($words) === 1) {
            return strtoupper(substr($words[0], 0 , 1));
        }

        $first = substr($words[0], 0, 1);
        $last = substr(end($words), 0, 1);

        return strtoupper($first . $last);
    }

    public function addresses(){
        return $this->hasMany(Address::class, 'user_id');
    }
}
