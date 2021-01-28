<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commerces extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'telephone',
        'nomCommerce',
        'type',
        'adresse',
        'code',
        'ville',
        'user_id',
        'description',
        'url_image',
        'email'
    ];

    // public function produit(){
        
    //     return $this->hasMany(Produit::class)->latest();
        
    // }

    public function articles(){
        
        return $this->hasMany(Articles::class)->latest();
        
    }

    public function commandes(){
        
        return $this->hasMany(Commandes::class)->latest();
        
    }
}
