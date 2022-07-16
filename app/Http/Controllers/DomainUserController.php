<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDomainUserRequest;
use App\Http\Requests\UpdateDomainUserRequest;
use App\Models\Domain;
use App\Models\DomainUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class DomainUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = DomainUser::with(["domain"])->get();
        $domains = Domain::all();
        return Inertia::render('DomainUsers', ['domains' => $domains, 'users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDomainUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDomainUserRequest $request)
    {
        $user = new DomainUser([
            'domain_id' => $request->get('domain_id'),
            'user' => $request->get('user'),
            'password' => Hash::make($request->get('password'))
        ]);
        $user->save();
        return redirect(route('domain-user.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DomainUser  $domainUser
     * @return \Illuminate\Http\Response
     */
    public function show(DomainUser $domainUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DomainUser  $domainUser
     * @return \Illuminate\Http\Response
     */
    public function edit(DomainUser $domainUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDomainUserRequest  $request
     * @param  \App\Models\DomainUser  $domainUser
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDomainUserRequest $request, DomainUser $domainUser)
    {
        $update = [
            'domain_id' => $request->get('domain_id'),
            'user' => $request->get('user'),
        ];
        if ($request->get('password')) {
            $update['password'] = Hash::make($request->get('password'));
        }
        $domainUser->update($update);
        return redirect(route('domain-user.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DomainUser  $domainUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(DomainUser $domainUser)
    {
        //
    }
}
