<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subunit extends Model
{
    use HasFactory;

    protected $table = 'subunits';

    protected $fillable = ['unit_id', 'subunit'];

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }
}
