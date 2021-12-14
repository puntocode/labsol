<?php

namespace App\Models;

use App\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','last_name','email','password','phone','uuid'];
    protected $appends  = [ 'fullname', 'abbreviation', 'rol' ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'status' => 'boolean'
    ];

    // public function roles()
    // {
    //     return $this->belongsToMany('App\Models\Role')->withTimestamps();
    // }

    // public function authorizeRoles($roles)
    // {
    //     if ($this->hasAnyRole($roles)) {
    //         return true;
    //     }
    //     abort(401, 'Esta acción no está autorizada.');
    // }
    // public function hasAnyRole($roles)
    // {
    //     if (is_array($roles)) {
    //         foreach ($roles as $role) {
    //             if ($this->hasRole($role)) {
    //                 return true;
    //             }
    //         }
    //     } else {
    //         if ($this->hasRole($roles)) {
    //             return true;
    //         }
    //     }
    //     return false;
    // }
    // public function hasRole($role)
    // {
    //     if ($this->roles()->where('name', $role)->first()) {
    //         return true;
    //     }
    //     return false;
    // }

    // public function isAdmin()
    // {
    //     if ($this->roles()->where('name', 'Administrador')->first()) {
    //         return true;
    //     }
    //     return false;
    // }

    // public function getRol(){
    //     return $this->roles()->first();
    // }

    // public function fullName(){
    //     return $this->name . ' ' . $this->last_name;
    // }




    # MUTADORES -----------------------------------------------------------------------------------
    public function getRolAttribute(){
        $rol = $this->roles->first()->name;
        return str_replace('_', ' ', $rol);
    }

    public function getStatusAttribute(){
        return $this->attributes['status'] ? 'ACTIVO' : 'INACTIVO';
    }

    public function getFullnameAttribute(){
        return $this->name . ' ' . $this->last_name;
    }

    public function getAbbreviationAttribute(){
        return $this->name[0] . '. ' . $this->last_name[0]. '.';
    }


}
