<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DomainAlias extends Model
{
    use HasFactory;
    protected $fillable = [
        'source_id',
        'destination',
    ];

    public function domain()
    {
        return $this->hasOne(Domain::class, "id", "source_id");
    }
}
