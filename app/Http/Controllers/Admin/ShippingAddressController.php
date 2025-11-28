<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShippingAddress;
use App\Models\User;
use Illuminate\Http\Request;

class ShippingAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shippingAddresses = ShippingAddress::with('user')->paginate(10);
        return view('admin.shipping-addresses.index', compact('shippingAddresses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('admin.shipping-addresses.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address_line1' => 'required|string|max:255',
            'address_line2' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'postal_code' => 'required|string|max:20',
            'country' => 'required|string|max:100',
            'is_default' => 'nullable|boolean',
        ]);

        ShippingAddress::create($request->all());

        return redirect()->route('admin.shipping-addresses.index')
            ->with('success', 'Shipping address created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ShippingAddress  $shippingAddress
     * @return \Illuminate\Http\Response
     */
    public function show(ShippingAddress $shippingAddress)
    {
        return view('admin.shipping-addresses.show', compact('shippingAddress'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ShippingAddress  $shippingAddress
     * @return \Illuminate\Http\Response
     */
    public function edit(ShippingAddress $shippingAddress)
    {
        $users = User::all();
        return view('admin.shipping-addresses.edit', compact('shippingAddress', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ShippingAddress  $shippingAddress
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ShippingAddress $shippingAddress)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address_line1' => 'required|string|max:255',
            'address_line2' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'postal_code' => 'required|string|max:20',
            'country' => 'required|string|max:100',
            'is_default' => 'nullable|boolean',
        ]);

        $shippingAddress->update($request->all());

        return redirect()->route('admin.shipping-addresses.index')
            ->with('success', 'Shipping address updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShippingAddress  $shippingAddress
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShippingAddress $shippingAddress)
    {
        $shippingAddress->delete();

        return redirect()->route('admin.shipping-addresses.index')
            ->with('success', 'Shipping address deleted successfully.');
    }
}