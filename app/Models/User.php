<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'rol_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d-M-Y');
    }
    public function getDeletedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d-M-Y');
    }
    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d-M-Y');
    }
    public function scopeBetweenDate($query, $primero, $final)
    {
        return $query->whereBetween('created_at', [$primero, $final]);
    }
    public function publicacionInformativas()
    {
        return $this->hasMany(PublicacionInformativa::class);
    }
    public function publicacionAdopcions()
    {
        return $this->hasMany(PublicacionAdopcion::class);
    }
    public function solicitudAdopcions()
    {
        return $this->hasMany(SolicitudAdopcion::class);
    }
    public function perfil()
    {
        return $this->hasOne(Perfil::class);
    }
    public function adoptar()
    {
        return $this->hasMany(Mascota::class, 'propetario_id');
    }
    public function rol()
    {
        return $this->belongsTo(Rol::class);
    }
    public function bitacoras()
    {
        return $this->hasMany(Bitacora::class);
    }
}
