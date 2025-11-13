<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CctvService;

class CctvController extends Controller
{
    protected $service;

    public function __construct(CctvService $service)
    {
        $this->service = $service;
    }

    public function index()         { return $this->service->index(); }
    public function create(Request $r) { return $this->service->create($r); }
    public function store(Request $r)  { return $this->service->store($r); }
    public function show($id)       { return $this->service->show($id); }
    public function edit($id)       { return $this->service->edit($id); }
    public function update(Request $r, $id) { return $this->service->update($r, $id); }
    public function destroy($id)    { return $this->service->destroy($id); }

    // API routes
    public function apiStore(Request $r)  { return $this->service->apiStore($r); }
    public function apiUpdate(Request $r, $id) { return $this->service->apiUpdate($r, $id); }
    public function apiDestroy($id)       { return $this->service->apiDestroy($id); }

    public function downloadVlc($id) { return $this->service->downloadVlc($id); }
}
