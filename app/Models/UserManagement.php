<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserManagement extends Model
{
    use HasFactory;

    public $table = 'user_management';

    public $timestamps = false;

    protected $fillable = [
        'role_id',
        'menu_id',
    ];
}
