<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use App\Console\Commands\SendMonthlyReportsCommand;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command(SendMonthlyReportsCommand::class)
    ->monthlyOn(1, '6:00')  
    ->withoutOverlapping()
    ->onOneServer()
    ->runInBackground();
