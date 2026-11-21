<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class category extends Model
{
   
   use Hasfactory; 

   protected $fillable = ['nombre']; 

   public function imagenes()
   {
   return $this->hasMany(imagenes::class); 
   } 
}
