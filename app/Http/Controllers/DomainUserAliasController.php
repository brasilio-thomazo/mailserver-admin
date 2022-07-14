<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDomainUserAliasRequest;
use App\Http\Requests\UpdateDomainUserAliasRequest;
use App\Models\DomainUserAlias;

class DomainUserAliasController extends Controller
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
     * @param  \App\Http\Requests\StoreDomainUserAliasRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDomainUserAliasRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DomainUserAlias  $domainUserAlias
     * @return \Illuminate\Http\Response
     */
    public function show(DomainUserAlias $domainUserAlias)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DomainUserAlias  $domainUserAlias
     * @return \Illuminate\Http\Response
     */
    public function edit(DomainUserAlias $domainUserAlias)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDomainUserAliasRequest  $request
     * @param  \App\Models\DomainUserAlias  $domainUserAlias
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDomainUserAliasRequest $request, DomainUserAlias $domainUserAlias)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DomainUserAlias  $domainUserAlias
     * @return \Illuminate\Http\Response
     */
    public function destroy(DomainUserAlias $domainUserAlias)
    {
        //
    }
}
