<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Voucher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CheckoutController extends Controller
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
    public function store(Request $request, Event $event)
    {
        $request->validate([
            'buyer_name' => 'required|string|max:100',
            'buyer_nik' => 'required|digits:16',
            'payment_method' => 'required|string|max:50',
            'voucher_code' => 'nullable|string|max:50',
        ]);

        DB::beginTransaction();
        try {
            // Cek kuota
            if ($event->quota <= 0) {
                return back()->with('error', 'Tiket sudah habis.');
            }

            $voucher = null;
            $discount = 0;

            // Jika pakai voucher
            if ($request->voucher_code) {
                $voucher = Voucher::where('code', $request->voucher_code)
                    ->where('status', 'active')
                    ->where('quota', '>', 0)
                    ->where('valid_until', '>=', now())
                    ->first();

                if (!$voucher) {
                    return back()->with('error', 'Voucher tidak valid.');
                }

                $discount = $voucher->discount_percentage;
                $voucher->decrement('quota');
            }

            // Gunakan harga tiket dari event
            $price = $event->ticket_price;
            $discountAmount = $price * $discount / 100;
            $totalPrice = $price - $discountAmount;

            // Simpan order
            $order = Order::create([
                'user_id' => Auth::id(),
                'event_id' => $event->id,
                'voucher_id' => $voucher ? $voucher->id : null,
                'payment_method' => $request->payment_method,
                'total_price' => $totalPrice,
            ]);

            // Simpan detail
            OrderDetail::create([
                'order_id' => $order->id,
                'buyer_name' => $request->buyer_name,
                'buyer_nik' => $request->buyer_nik,
                'ticket_code' => strtoupper(Str::random(10)),
            ]);

            // Kurangi kuota event
            $event->decrement('quota');

            DB::commit();
            return redirect()->route('ticket.show', $order->id)->with('success', 'Tiket berhasil dipesan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat memproses pembelian.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event, Request $request)
    {
        $voucherCode = session('voucher_code');
        $price = $event->ticket_price;
        $totalPrice = session('total_price', $price);

        return view('checkout.show', compact('event', 'totalPrice', 'voucherCode'));
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
