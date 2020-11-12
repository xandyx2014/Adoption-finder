<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Especie extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['nombre', 'descripcion'];
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
    public function mascotas()
    {
        return $this->hasMany(Mascota::class);
    }
    public function scopeBetweenDate($query, $primero, $final)
    {
        return $query->whereBetween('created_at', [$primero, $final]);
    }
}
