<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadAttribute extends Model
{
    use HasFactory;

    protected $fillable = ['lead_id', 'key', 'value'];

    // Relación con el lead
    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }
}
