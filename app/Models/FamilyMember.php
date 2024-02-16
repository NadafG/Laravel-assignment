<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyMember extends Model
{
    use HasFactory;

    public function family()
    {
        return $this->belongsTo(Family::class, 'head_family_id');
    }
}
