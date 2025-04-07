<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MasterGroup extends Model
{

    use HasFactory;

    public $table = 'master_group';

    public $timestamps = false;

    protected $fillable = [
        'code',
        'leader_id',
    ];

    public function leader()
    {
        return $this->hasOne(User::class, 'leader_id');
    }
    public function mainGroup()
    {
        return $this->hasMany(MainGroup::class, 'id');
    }
    
}
