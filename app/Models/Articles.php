<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom',
        'prix',
        'quantite',
        'description',
        'commerces_id',
        'url_image'
    ];

    public function avisProduit(){
        return $this->hasMany(Avis::class)->latest();
    }
}
