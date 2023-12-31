<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Masyarakat extends Model
{
    use HasApiTokens, HasFactory;

    protected $table = 'masyarakats';

    protected $fillable = [
        'nik',
        'name',
        'email',
        'password'
    ];
}
