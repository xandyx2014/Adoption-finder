<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Mascota extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'nombre',
        'color',
        'descripcion',
        'tamagno',
        'salud',
        'especie_id',
        'raza_id',
        'user_id',
        'about' ];
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
    public function etiquetas()
    {
        return $this->belongsToMany(Etiqueta::class);
    }
    public function raza()
    {
        return $this->belongsTo(Raza::class);
    }
    public function especie()
    {
        return $this->belongsTo(Especie::class);
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
