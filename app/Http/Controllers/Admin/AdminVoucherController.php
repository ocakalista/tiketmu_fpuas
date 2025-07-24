<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Voucher;
use Illuminate\Support\Str;

class AdminVoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vouchers = Voucher::latest()->paginate(10);
        return view('admin.vouchers.index', compact('vouchers'));
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
        $data = $request->validate([
            'quota' => 'required|integer|min:1',
            'status' => 'required|in:active,inactive',
            'valid_until' => 'required|date|after:today',
            'discount_percentage' => 'required|integer|min:1|max:100',
        ]);

        do {
            $code = 'VCH-' . strtoupper(Str::random(6));
        } while (Voucher::where('code', $code)->exists());

        $data['code'] = $code;

        Voucher::create($data);
        return redirect()->back()->with('success', 'Voucher created.');
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
        $voucher = Voucher::findOrFail($id);

        $data = $request->validate([
            'quota' => 'required|integer|min:1',
            'status' => 'required|in:active,inactive',
            'valid_until' => 'required|date|after:today',
            'discount_percentage' => 'required|integer|min:1|max:100',
        ]);

        $voucher->update($data);

        return redirect()->back()->with('success', 'Voucher updated.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Voucher $voucher)
    {
        $voucher->delete();

        return redirect()->route('admin.vouchers.index')->with('success', 'Voucher deleted.');
    }
}
