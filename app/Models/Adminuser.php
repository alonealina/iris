<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adminuser extends Model
{
    use HasFactory;

    protected $table = 'adminuser';
    protected $guarded = ['id']; 
    
}
