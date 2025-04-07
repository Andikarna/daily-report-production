<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterProduct extends Model
{
    use HasFactory;
    
    public $table = 'master_product';

    public $timestamps = false;

    protected $fillable = [
        'name',
    ];
}
