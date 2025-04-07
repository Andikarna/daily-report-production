<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MainGroup extends Model
{
    use HasFactory;

    public $table = 'main_group';

    public $timestamps = false;

    protected $fillable = [
        'group_id',
        'user_id'
    ];
    
    public function user()
    {
        return $this->hasOne(User::class, 'user_id');
    }

    // public function group()
    // {
    //     return $this->hasOne(MasterGroup::class, 'group_id');
    // }

    public function group()
{
    return $this->belongsTo(MasterGroup::class, 'group_id');
}
}
