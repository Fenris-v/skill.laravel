<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class HistoryPivot extends Pivot
{
    protected $casts = [
        'after' => 'array',
        'before' => 'array'
    ];
}
