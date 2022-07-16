<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDomainUserAliasRequest;
use App\Http\Requests\UpdateDomainUserAliasRequest;
use App\Models\DomainUser;
use App\Models\DomainUserAlias;
use Inertia\Inertia;

class DomainUserAliasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aliases = DomainUserAlias::with('user', 'user.domain')->get();
        $users = DomainUser::with('domain')->get();
        return Inertia::render('DomainUserAliases', [
            'aliases' => $aliases,
            'users' => $users,
        ]);
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
     * @param  \App\Http\Requests\StoreDomainUserAliasRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDomainUserAliasRequest $request)
    {
        $alias = new DomainUserAlias([
            'source_id' => $request->get('source_id'),
            'destination' => $request->get('destination')
        ]);
        $alias->save();
        return redirect(route('domain-user-alias.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DomainUserAlias  $alias
     * @return \Illuminate\Http\Response
     */
    public function show(DomainUserAlias $alias)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DomainUserAlias  $alias
     * @return \Illuminate\Http\Response
     */
    public function edit(DomainUserAlias $alias)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDomainUserAliasRequest  $request
     * @param  \App\Models\DomainUserAlias  $alias
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDomainUserAliasRequest $request, DomainUserAlias $alias)
    {
        $alias->update([
            'source_id' => $request->get('source_id'),
            'destination' => $request->get('destination')
        ]);
        return redirect(route('domain-user-alias.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DomainUserAlias  $alias
     * @return \Illuminate\Http\Response
     */
    public function destroy(DomainUserAlias $alias)
    {
        $alias->delete();
    }
}
