<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class PublicacionInformativa extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['titulo', 'subtitulo', 'cuerpo', 'user_id', 'tipo_publicacion_id'];
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
    public function denuncias()
    {
        return $this->morphMany(Denuncia::class, 'denunciable');
    }
    public function tipoPublicacion()
    {
        return $this->belongsTo(TipoPublicacion::class);
    }
    public function imagens()
    {
        return $this->morphMany(Imagen::class, 'imagenable');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
