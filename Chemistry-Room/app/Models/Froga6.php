<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class froga6 extends Model
{
    use HasFactory;

    protected $table = "Froga6";

    protected $primaryKey = "id";
 
    protected $fillable = ['izena', 'emaitza', 'zhitz', 'id_pista'];

    public function Pistak(){

        return $this->belongsTo(Pistak::class);
            
        }
}