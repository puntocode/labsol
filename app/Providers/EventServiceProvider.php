<?php

namespace App\Providers;

use App\Models\Expediente;
use App\Models\Historycalibration;
use App\Observers\ExpedienteObserver;
use Illuminate\Auth\Events\Registered;
use App\Observers\HistorycalibrationObserver;
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
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Expediente::observe(ExpedienteObserver::class);
        Historycalibration::observe(HistorycalibrationObserver::class);
    }
}
