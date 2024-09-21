<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use Illuminate\Http\Request;
use App\Http\Resources\UploadResource;

class UploadController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Upload::class, 'upload');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // show all for the specific user by using eloquent relationship
        $userUploads = auth()->user()->uploads;
        return UploadResource::collection($userUploads);


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Upload $upload)
    {
      
       $upload= Upload::find($upload);

       return new UploadResource($upload);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Upload $upload)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Upload $upload)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Upload $upload)
    {
        //
    }
}
