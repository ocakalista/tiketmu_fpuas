<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Order;
use App\Models\User;
use App\Models\Voucher;
use Carbon\Carbon;
use DB;

class AdminDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $year = $request->get('year', now()->year);

        $voucherAktif = Voucher::where('status', 'active')
            ->where('valid_until', '>=', now())
            ->count();

        $eventAktif = Event::where('event_date', '>=', now())->count();

        $orderTahunIni = Order::whereYear('created_at', $year)->count();

        $totalPendapatan = Order::whereYear('created_at', $year)->sum('total_price');

        $jumlahUser = User::where('role', 'user')->count();

        $orderBulanan = Order::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereYear('created_at', $year)
            ->groupByRaw('MONTH(created_at)')
            ->pluck('total', 'month');

        return view('admin.dashboard', compact(
            'year',
            'voucherAktif',
            'eventAktif',
            'orderTahunIni',
            'jumlahUser',
            'totalPendapatan',
            'orderBulanan'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
