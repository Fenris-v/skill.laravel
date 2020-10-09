<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class HistoryPivot extends Pivot
{
    protected $casts = [
        'after' => 'array',
        'before' => 'array'
    ];
}
