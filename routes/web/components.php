<?php

use App\Http\Controllers\Components;
use Illuminate\Support\Facades\Route;

// Components
Route::group(['prefix' => 'components', 'middleware' => ['auth']], function () {
    Route::get(
        '{componentID}/checkout',
        [Components\ComponentCheckoutController::class, 'create']
    )->name('components.checkout.show');

    Route::post(
        '{componentID}/checkout',
        [Components\ComponentCheckoutController::class, 'store']
    )->name('components.checkout.store');

    Route::get(
        '{componentID}/checkin/{backto?}',
        [Components\ComponentCheckinController::class, 'create']
    )->name('components.checkin.show');

    Route::post(
        '{componentID}/checkin/{backto?}',
        [Components\ComponentCheckinController::class, 'store']
    )->name('components.checkin.store');

    Route::group(['prefix' => 'serials'], function () {
        Route::get(
            '{serialID}/edit',
            [Components\Serials\SerialsController::class, 'edit']
        )->name('components.serials.edit');

        Route::put(
            '{serialID}',
            [Components\Serials\SerialsController::class, 'update']
        )->name('components.serials.update');

        Route::delete(
            '{serialID}',
            [Components\Serials\SerialsController::class, 'destroy']
        )->name('components.serials.destroy');
    });

});

Route::resource('components', Components\ComponentsController::class, [
    'middleware' => ['auth'],
    'parameters' => ['component' => 'component_id'],
]);
