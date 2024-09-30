<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = ['rut', 'name', 'email'];

    // Relación con los leads
    public function leads()
    {
        return $this->hasMany(Lead::class);
    }
}
