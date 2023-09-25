<?php

namespace App\Http\Controllers;

use App\Models\DailyFoundTarget;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $torrents = DailyFoundTarget::query()
            ->whereRelation('target', 'created_by', '=', request()->user()->id)
            ->whereDate('created_at', Carbon::today())
            ->orderBy('id', 'desc')
            ->paginate(request('per_page', 6));

        return view('dashboard', compact('torrents'));
    }
}
