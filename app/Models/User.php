<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'telephone',
        'password',
        'status',
        'solde',
        'adresse',
        'code',
        'ville',
    ];

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
    ];

    public function commerces(){
        
        return $this->hasMany(Commerces::class)->latest();
        
    }

    public function avisProduit(){
        return $this->hasMany(Avis::class)->latest();
    }

    public function commandes(){
        
        return $this->hasMany(Commandes::class)->latest();
        
    }

    public function corespondants(){
        return $this->belongsToMany(User::class, 'corespondants', 'expediteur_id', 'destinataire_id');
    }

    
    public function destinataire(){
        return $this->hasMany(Messages::class, 'destinataire_id')->latest();
    }

    

    public function expediteur(){
        return $this->hasMany(Messages::class, 'expediteur_id')->latest();
        

    }

    // public function messages(){
    //     return $this->belongsToMany(User::class, 'messages', 'destinataire_id', 'expediteur_id');
    // }


}
