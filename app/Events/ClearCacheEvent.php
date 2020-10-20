<?php

namespace App\Events;

use App\Interfaces\Cache;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ClearCacheEvent
{
    use Dispatchable, SerializesModels;

    public Cache $object;

    /**
     * Create a new event instance.
     *
     * @param $object
     */
    public function __construct(Cache $object)
    {
        $this->object = $object;
    }
}
