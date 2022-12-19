<?php

namespace App\Http\Controllers\Subscriber;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $title = trans('dashboard.label');

        return Inertia::render('Subscriber/Dashboard', compact(
            'title'
        ));
    }
}
