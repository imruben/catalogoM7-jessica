<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bag extends Model
{
    use HasFactory;
    protected $fillable=['name','price','user_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}