<?php

namespace App\Providers;

use App\Events\PostCreated;
use App\Events\PostEdited;
use App\Events\PostPublished;
use App\Events\PostRemoved;
use App\Events\PostUnpublished;
use App\Listeners\SendPostCreatedNotification;
use App\Listeners\SendPostEditedNotification;
use App\Listeners\SendPostPublishedNotification;
use App\Listeners\SendPostRemovedNotification;
use App\Listeners\SendPostUnpublishedNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        PostCreated::class => [
            SendPostCreatedNotification::class
        ],
        PostEdited::class => [
            SendPostEditedNotification::class
        ],
        PostPublished::class => [
            SendPostPublishedNotification::class
        ],
        PostUnpublished::class => [
            SendPostUnpublishedNotification::class
        ],
        PostRemoved::class => [
            SendPostRemovedNotification::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
