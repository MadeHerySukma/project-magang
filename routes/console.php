<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

// ============================================
// ARTISAN COMMANDS
// ============================================

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

// ============================================
// ⬇️ SCHEDULER - AUTO CANCEL EXPIRED BOOKINGS
// ============================================

Schedule::command('bookings:cancel-expired')
    ->everyMinute()
    ->withoutOverlapping()
    ->runInBackground()
    ->onSuccess(function () {
        // Log success jika diperlukan
    })
    ->onFailure(function () {
        // Log failure jika diperlukan
    });