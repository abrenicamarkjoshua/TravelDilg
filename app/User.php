<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
    protected $fillable = [
        'accountStatus',
        'lastname',
        'firstname',
        'middlename',
        'suffix',
        'name',
        'email',
        'password',
        'region',
        'province',
        'municipality',
        'department_id',
        'contactnumber',
        'accountType_id'
    ];
    public function accounttype(){
        if($this->accountType_id != 0){
        $output =  accountType::find($this->accountType_id)->accountType;
            if($output){
            return "Account type: $output";
            }
            else{
                return "";
            }
        }
    }
}
