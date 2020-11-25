<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class PublicacionAdopcion extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['titulo', 'descripcion_corta', 'user_id', 'mascota_id'];
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
    public function denuncias()
    {
        return $this->morphMany(Denuncia::class, 'denunciable');
    }
    public function solicitudAdopcions()
    {
        return $this->hasMany(SolicitudAdopcion::class);
    }
    public function mascota()
    {
        return $this->belongsTo(Mascota::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
