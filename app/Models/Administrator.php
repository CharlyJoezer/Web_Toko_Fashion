<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Administrator extends Authenticatable
{
    use HasFactory;
    public function getAuthIdentifierName()
    {
        return 'id_administrator';
    }
    protected $table = 'administrators';
    protected $guarded = ['id_administrator'];
}
