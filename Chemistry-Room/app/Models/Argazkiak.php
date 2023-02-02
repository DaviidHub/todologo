<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class argazkiak extends Model
{
    use HasFactory;

    protected $table = "Argazkiak";

    protected $primaryKey = "id";
 
    protected $fillable = ['izena', 'argazkia'];
}
