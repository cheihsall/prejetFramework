<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class formul extends Model
{

    use HasFactory;
    
    protected $fillable = [

        'nom', 
        'prenom',
        'email', 
        'passwords',
        'passwords2',
        'role',

    ];
    
}
