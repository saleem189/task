<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConnectionsInCommonRequest;
use App\Http\Requests\StoreConnectionsInCommonRequest;
use App\Http\Requests\UpdateConnectionsInCommonRequest;
use App\Models\ConnectionsInCommon;
use App\Models\Requests;
use App\Services\CommonConnectionService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class ConnectionsInCommonController extends Controller
{
    public function __construct(private readonly CommonConnectionService $commonConnectionService){}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): JsonResponse
    {
        $commonConnections = $this->commonConnectionService->getConnections();
        return response()->json([
            'data' => $commonConnections
        ], HttpFoundationResponse::HTTP_OK);
         
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
     * @param  \App\Http\Requests\StoreConnectionsInCommonRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreConnectionsInCommonRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ConnectionsInCommon  $connectionsInCommon
     * @return \Illuminate\Http\Response
     */
    public function show(ConnectionsInCommon $connectionsInCommon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ConnectionsInCommon  $connectionsInCommon
     * @return \Illuminate\Http\Response
     */
    public function edit(ConnectionsInCommon $connectionsInCommon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateConnectionsInCommonRequest  $request
     * @param  \App\Models\ConnectionsInCommon  $connectionsInCommon
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateConnectionsInCommonRequest $request, ConnectionsInCommon $connectionsInCommon)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ConnectionsInCommon  $connectionsInCommon
     * @return \Illuminate\Http\Response
     */
    public function destroy(ConnectionsInCommonRequest $request,Requests $id)
    {
        $id->delete();
    }
}
