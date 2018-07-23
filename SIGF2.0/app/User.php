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
        'profile',
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

        return $this->belongsToMany('App\Classroom', 'user_classrooms', 'user_id');
    }

    public function classes(){

        return $this->belongsToMany('App\Classes', 'attendences', 'user_id', 'class_id');
    }

    public function getNotDirectors(){

        return $this->where('isDirector', '=', 0)->orderBy('name')->get();
    }

    public function getNotProfessors(){

        return $this->where('isProfessor', '=', 0)->orderBy('name')->get();
    }

    public function becomeDirector(){

        $this->isDirector = 1;

        $result = $this->save();

        return ($result) ? true : false;
    }

    public function removeDirector(){

        $this->isDirector = 0;

        $result = $this->save();

        return ($result) ? true : false;
    }

    public function becomeProfessor(){

        $this->isProfessor = 1;

        $result = $this->save();

        return ($result) ? true : false;
    }

    public function removeProfessor(){

        $this->isProfessor = 0;

        $result = $this->save();

        return ($result) ? true : false;
    }
}
