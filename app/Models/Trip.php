<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    public function transportation()
    {
        return $this->belongsTo(Transportation::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
