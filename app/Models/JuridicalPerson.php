<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JuridicalPerson extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'organization_name',
        'first_name',
        'last_name',
        'patronymic',
    ];
}
