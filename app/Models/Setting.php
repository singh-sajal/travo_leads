<?php

namespace App\Models;

use App\Traits\Sluggify;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory, Sluggify;
    protected $slugSource='key';
    protected $guarded = ['id'];
}
