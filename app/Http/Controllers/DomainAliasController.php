<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDomainAliasRequest;
use App\Http\Requests\UpdateDomainAliasRequest;
use App\Models\Domain;
use App\Models\DomainAlias;
use Inertia\Inertia;

class DomainAliasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $domains = Domain::all();
        $aliases = DomainAlias::with('domain')->get();

        return Inertia::render('DomainAliases', [
            'domains' => $domains,
            'aliases' => $aliases,
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
     * @param  \App\Http\Requests\StoreDomainAliasRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDomainAliasRequest $request)
    {
        $alias = new DomainAlias($request->all());
        $alias->save();
        return redirect(route('domain-alias.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DomainAlias  $alias
     * @return \Illuminate\Http\Response
     */
    public function show(DomainAlias $alias)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DomainAlias  $alias
     * @return \Illuminate\Http\Response
     */
    public function edit(DomainAlias $alias)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDomainAliasRequest  $request
     * @param  \App\Models\DomainAlias  $alias
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDomainAliasRequest $request, DomainAlias $alias)
    {
        $alias->update([
            'source_id' => $request->get('source_id'),
            'destination' => $request->get('destination')
        ]);
        return redirect(route('domain-alias.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DomainAlias  $alias
     * @return \Illuminate\Http\Response
     */
    public function destroy(DomainAlias $alias)
    {
        $alias->delete();
        return redirect(route('domain-alias.index'));
    }
}
