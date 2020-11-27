<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    use HasFactory;
    protected $fillable = [
        'apellidos',
        'apodo',
        'telefono',
        'about',
        'user_id'
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
    public function imagen()
    {
        return $this->hasOne(Imagen::class, 'imagenable');
    }
}
