<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DomainUserAlias extends Model
{
    use HasFactory;

    protected $fillable = [
        'source_id',
        'destination'
    ];

    public function user()
    {
        return $this->hasOne(DomainUser::class, "id", "source_id");
    }
}
