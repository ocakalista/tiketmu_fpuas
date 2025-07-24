<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(Order $order, Request $request)
    {
        if ($order->user_id !== Auth::id() && Auth::user()->role !== 'admin') {
            abort(403);
        }
        $order->load('event', 'orderDetail');
        $ticketCode = $order->orderDetail->first()->ticket_code;
        $qrCode = QrCode::size(200)->generate($ticketCode);
        $isExpired = \Carbon\Carbon::now()->gt($order->event->event_date);
        $voucher = $order->voucher;
        $price = $order->total_price;
        $voucherCode = $request->get('voucher_code');

        return view('ticket.show', compact('order', 'qrCode', 'isExpired', 'voucher', 'price', 'voucherCode'));
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
