<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $guarded = ['id']; 
    
    public function getActiveTextAttribute() {
        if ($this->active_flg) {
            return 'ACTIVE';
        } else {
            return 'NON ACTIVE';
        };
    }

    public function outputCsvContent() {
        return [
            $this->name,
            $this->tel,            
            $this->mail,    
            $this->pass,         
            $this->code,       
            $this->uid,
            $this->api_key,
            $this->secret_key,
            $this->txid,
            $this->active_text,
            $this->created_at,
        ];
    }
}
