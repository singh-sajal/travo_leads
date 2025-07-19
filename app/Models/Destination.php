<?php

namespace App\Models;

use App\Models\Package;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Destination extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function package(){
        return $this->hasMany(Package::class,'destination_id','id');
    }
}
