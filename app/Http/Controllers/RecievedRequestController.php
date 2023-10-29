<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecievedRequestsRequest;
use App\Http\Requests\StoreRequestsRequest;
use App\Http\Requests\UpdateRequestsRequest;
use App\Models\Requests;
use App\Services\RequestsServices;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class RecievedRequestController extends Controller
{
    public function __construct(private readonly RequestsServices $requestsService){}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): JsonResponse
    {
        $list  = $this->requestsService->getRecievedRequests();
        return response()->json([
            'data' => $list ?: null
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
     * @param  \App\Http\Requests\StoreRequestsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequestsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Requests  $requests
     * @return \Illuminate\Http\Response
     */
    public function show(Requests $requests)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Requests  $requests
     * @return \Illuminate\Http\Response
     */
    public function edit(Requests $requests)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRequestsRequest  $request
     * @param  \App\Models\Requests  $requests
     * @return \Illuminate\Http\Response
     */
    public function update(RecievedRequestsRequest $request, Requests $id)
    {
        return response()->json([
            'data' => $this->requestsService->updateRequest($request->validated('status'), $id)
        ], HttpFoundationResponse::HTTP_ACCEPTED);
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Requests  $requests
     * @return \Illuminate\Http\Response
     */
    public function destroy(RecievedRequestsRequest $requests)
    {
        
    }
}
