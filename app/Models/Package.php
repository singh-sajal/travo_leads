<?php

namespace App\Models;

use App\Models\Query;
use App\Models\Destination;
use App\Models\PackageImage;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\CssSelector\Node\FunctionNode;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Package extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    public function destination()
    {
        return $this->belongsTo(Destination::class, 'destination_id', 'id');
    }

    public function queries(){
        return $this->hasMany(Query::class,'package_id','id');
    }
}
