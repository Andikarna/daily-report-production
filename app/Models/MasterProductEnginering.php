<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterProductEnginering extends Model
{
    use HasFactory;

    public $table = 'master_product_enginering';

    public $timestamps = false;

    protected $fillable = [
        'master_id',
        'date',
        'ip',
        'divisi_id',
        'result_of_time',
        'status',
    ];

}
