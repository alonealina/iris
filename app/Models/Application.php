<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $guarded = ['id']; 
    
    public function outputCsvContent() {
        return [
            $this->name,
            $this->tel,            
            $this->mail,    
            $this->pass,         
            $this->code,       
            $this->uid,
            $this->txid,
            $this->created_at,
            $this->updated_at,
        ];
    }
}
