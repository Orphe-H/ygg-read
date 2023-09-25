<?php

namespace App\Http\Controllers;

use App\Models\DailyFoundTarget;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $torrents = DailyFoundTarget::whereRelation('target', 'user_id', request()->user()->id)->orderBy('id', 'desc')->where('created_at', Carbon::today())->paginate(request('per_page', 6));

        return view('dashboard', compact('torrents'));
    }
}
