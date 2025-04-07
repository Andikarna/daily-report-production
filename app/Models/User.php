<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'remember_token',
        'updated_at',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function userRole(): BelongsTo
    {
        return $this->belongsTo(UserRole::class, 'role_id');
    }

    public function report_production()
    {
        return $this->hasOne(ReportProduction::class, 'leader_id', 'id');
    }

    public function report_approval()
    {
        return $this->hasOne(ReportApproval::class, 'approval_id', 'id');
    }

    public function dailyAchievement()
    {
        return $this->hasMany(DailyAchievement::class, 'operator_id');
    }

    public function mainGroup()
    {
        return $this->hasMany(MainGroup::class, 'user_id');
    }

    public function masterGroup()
    {
        return $this->hasMany(MasterGroup::class, 'leader_id');
    }
}

