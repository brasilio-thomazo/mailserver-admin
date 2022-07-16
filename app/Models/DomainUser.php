<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DomainUser extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'domain_id',
        'user',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    public function domain()
    {
        return $this->hasOne(Domain::class, "id", "domain_id");
    }

    public function alias()
    {
        return $this->hasOne(DomainUserAlias::class, "source_id", "id");
    }
}
