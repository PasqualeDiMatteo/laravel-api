<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function type()
    {
        return  $this->belongsTo(Type::class);
    }

    public function technologies()
    {
        return  $this->belongsToMany(Technology::class);
    }
}
