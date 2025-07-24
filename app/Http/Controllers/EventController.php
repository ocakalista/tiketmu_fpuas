<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Voucher;


class EventController extends Controller
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
    public function show(Event $event, Request $request)
    {
        // Ambil harga tiket dari event
        $price = $event->ticket_price;

        // Inisialisasi diskon
        $discount = 0;

        // Cek voucher jika ada
        if ($request->has('voucher_code')) {
            $voucherCode = $request->voucher_code;
            $voucher = Voucher::where('code', $voucherCode)
                ->where('status', 'active')
                ->where('quota', '>', 0)
                ->where('valid_until', '>=', now())
                ->first();

            if ($voucher) {
                // Voucher valid, terapkan diskon
                $discount = $voucher->discount_percentage;
                session(['voucher_code' => $voucherCode]);  // Simpan voucher secara persisten
            } else {
                // Voucher tidak valid, beri pesan error
                session()->flash('voucher_error', 'Voucher tidak valid atau sudah kadaluarsa.');
                session()->forget('voucher_code');  // Hapus voucher dari session jika tidak valid
            }
        } else {
            // Jika voucher_code tidak ada, pastikan untuk menghapus voucher_code dari session
            session()->forget('voucher_code');
        }

        // Hitung total price dengan diskon jika ada
        $discountAmount = $price * $discount / 100;
        $totalPrice = $price - $discountAmount;

        // Simpan harga final di session agar bisa diakses di halaman checkout
        session(['total_price' => $totalPrice]);

        return view('events.show', compact('event'));
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

    public function toggleLike(Event $event)
    {
        $user = auth()->user();

        // Jika user sudah like event, kita un-like (hapus dari tabel event_likes)
        if ($user->hasLikedEvent($event)) {
            $user->likes()->detach($event);
            $event->decrement('total_likes');
        } else {
            // Jika belum like, kita tambahkan like
            $user->likes()->attach($event);
            $event->increment('total_likes');
        }

        return back();
    }
}
