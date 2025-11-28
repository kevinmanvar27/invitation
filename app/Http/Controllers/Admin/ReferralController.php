<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Referral;
use App\Models\User;
use Illuminate\Http\Request;

class ReferralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $referrals = Referral::with(['referrer', 'referred'])->paginate(10);
        return view('admin.referrals.index', compact('referrals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('admin.referrals.create', compact('users'));
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
            'referrer_user_id' => 'required|exists:users,id',
            'referred_user_id' => 'required|exists:users,id|different:referrer_user_id',
            'reward_earned' => 'required|numeric|min:0',
            'status' => 'required|in:pending,completed',
        ]);

        Referral::create($request->all());

        return redirect()->route('admin.referrals.index')
            ->with('success', 'Referral created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Referral  $referral
     * @return \Illuminate\Http\Response
     */
    public function show(Referral $referral)
    {
        return view('admin.referrals.show', compact('referral'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Referral  $referral
     * @return \Illuminate\Http\Response
     */
    public function edit(Referral $referral)
    {
        $users = User::all();
        return view('admin.referrals.edit', compact('referral', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Referral  $referral
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Referral $referral)
    {
        $request->validate([
            'referrer_user_id' => 'required|exists:users,id',
            'referred_user_id' => 'required|exists:users,id|different:referrer_user_id',
            'reward_earned' => 'required|numeric|min:0',
            'status' => 'required|in:pending,completed',
        ]);

        $referral->update($request->all());

        return redirect()->route('admin.referrals.index')
            ->with('success', 'Referral updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Referral  $referral
     * @return \Illuminate\Http\Response
     */
    public function destroy(Referral $referral)
    {
        $referral->delete();

        return redirect()->route('admin.referrals.index')
            ->with('success', 'Referral deleted successfully.');
    }
}