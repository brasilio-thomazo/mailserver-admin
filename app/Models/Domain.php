<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Domain extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'home',
        'uid',
        'gid',
    ];

    public function alias()
    {
        return $this->hasOne(DomainAlias::class, "source_id", "id");
    }

    public function users()
    {
        return $this->hasMany(DomainUser::class, "domain_id", "id");
    }
}
