<?php

use Illuminate\Support\Facades\Route;
use App\Models\Invoice;
Route::get('/', function () {
    return view('welcome');
});


Route::get('/test-invoices', function () {
    // 'with()' loads the related records instantly, preventing N+1 issues!
    $invoices = Invoice::with(['student', 'payments'])->get();

    return view('test-invoices', compact('invoices'));
});
