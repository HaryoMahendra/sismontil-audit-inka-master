<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as ContractsAuditable;
use OwenIt\Auditing\Models\Audit;

class User extends Authenticatable implements ContractsAuditable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, Auditable;

    protected $table = "users";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        // 'nip',
        'name',
        'role_id',
        'departement_id',
        'username',
        'nip',
        'jabatan',
        'ttd',
        'password',
    ];

    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];
    public function ncr()
    {
        return $this->hasMany(Ncr::class, 'objek_audit', 'id');
    }
    public function ofi()
    {
        return $this->hasMany(Ofi::class, 'objek_audit', 'id');
    }
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function auditEvent($event, $id = null)
    {
        Audit::create([
            'auditable_type' => self::class,
            'user_type'      => self::class,
            'auditable_id'   => $this->id,
            'event'          => $event,
            'tags'           => $event,
            'user_id'        => $id,
            'url'            => request()->fullUrl(),
            'ip_address'     => request()->ip(),
            'user_agent'     => request()->userAgent(),
            'created_at'     => Carbon::now(),
        ]);
    }

    public function recordPageView($pageName)
    {
        $this->audits()->create([
            'event' => 'view',
            'tags' => 'view',
            'auditable_id' => $this->id,
            'auditable_type' => self::class,
            'old_values' => [],
            'new_values' => ['page' => $pageName],
            'url' => request()->fullUrl(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'user_id' => $this->id,
            'user_type' => self::class,
        ]);
    }
}
