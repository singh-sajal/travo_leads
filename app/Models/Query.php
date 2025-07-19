<?php

namespace App\Models;

use App\Models\Package;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Query extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id', 'id');
    }

    public function getPackageNameAttribute()
    {
        return $this->package?->name;
    }
}
