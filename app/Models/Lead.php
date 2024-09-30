<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = ['profile_id', 'source'];

    // Relación con el perfil
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    // Relación con los atributos del lead
    public function attributes()
    {
        return $this->hasMany(LeadAttribute::class);
    }
}
