<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDomainAliasRequest;
use App\Http\Requests\UpdateDomainAliasRequest;
use App\Models\DomainAlias;

class DomainAliasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DomainAlias  $domainAlias
     * @return \Illuminate\Http\Response
     */
    public function show(DomainAlias $domainAlias)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DomainAlias  $domainAlias
     * @return \Illuminate\Http\Response
     */
    public function edit(DomainAlias $domainAlias)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDomainAliasRequest  $request
     * @param  \App\Models\DomainAlias  $domainAlias
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDomainAliasRequest $request, DomainAlias $domainAlias)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DomainAlias  $domainAlias
     * @return \Illuminate\Http\Response
     */
    public function destroy(DomainAlias $domainAlias)
    {
        //
    }
}
