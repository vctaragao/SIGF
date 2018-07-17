<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'sex',
        'isDirector',
        'phone',
        'cpf',
        'course',
        'colar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function store($data){

        $this->name = $data->name;
        $this->cpf = $data->cpf;
        $this->email = $data->email;
        $this->phone = $data->phone;
        $this->email = $data->email;
        $this->sex = $data->sex;
        $this->course = $data->course;
        $this->colar = $data->colar;

        $this->save();

        return redirect('/Home');


    }

    public function classrooms(){

        return $this->belongsToMany('App\Classroom', 'user_classrooms');
    }
}
