<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserMenu extends Model
{
    use HasFactory;

    public $table = 'user_menu';

    public $timestamps = false;

    protected $fillable = [
        'name'
    ];
}
