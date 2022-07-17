<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDomainDkimRequest;
use App\Http\Requests\UpdateDomainDkimRequest;
use App\Models\Domain;
use App\Models\DomainDkim;
use Inertia\Inertia;

class DomainDkimController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $domains = Domain::all();
        $keys = DomainDkim::with(['domain'])->get();
        $algorithms = openssl_get_md_methods();
        $keys_dir = env('DKIM_KEYS_DIR', '/etc/dkimkeys');
        $config_file = env('DKIM_CONFIG_FILE', '/etc/opendkim.conf');
        return Inertia::render('DomainDkim', [
            'domains' => $domains,
            'keys' => $keys,
            'algorithms' => $algorithms,
            'keys_dir' => $keys_dir,
            'config_file' => $config_file
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDomainDkimRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDomainDkimRequest $request)
    {
        [$private_key, $public_key] = $request->keypair();

        $algorithm = $request->get('algorithm') ? $request->get('algorithm') : env('DKIM_ALGORITHM', 'sha256');
        $bits = $request->get('key_bits') ? $request->get('key_bits') : env('DKIM_KEY_BITS', 2048);
        $key_type = $request->get('key_type') ? $request->get('key_type') : env('DKIM_KEY_TYPE', 'rsa');

        $dkim = new DomainDkim([
            'domain_id' => $request->get('domain_id'),
            'selector' => $request->get('selector'),
            'private_key' => $private_key,
            'public_key' => $public_key,
            'algorithm' => $algorithm,
            'key_bits' => $bits,
            'key_type' => $key_type,
        ]);
        $dkim->save();
        return redirect(route('domain-dkim.index'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDomainDkimRequest  $request
     * @param  \App\Models\DomainDkim  $domainDkim
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDomainDkimRequest $request, DomainDkim $domainDkim)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DomainDkim  $domainDkim
     * @return \Illuminate\Http\Response
     */
    public function destroy(DomainDkim $domainDkim)
    {
        //
    }
}
