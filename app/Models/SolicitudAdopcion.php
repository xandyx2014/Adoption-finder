<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class SolicitudAdopcion extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'motivo',
        'descripcion',
        'estado',
        'user_id',
        'publicacion_adopcion_id'
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
    public function publicacion_adopcion()
    {
        return $this->belongsTo(PublicacionAdopcion::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
