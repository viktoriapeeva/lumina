<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use Illuminate\Http\Request;
use App\Http\Resources\UploadResource;
use App\Http\Requests\StoreUploadRequest;
use App\Models\UserUploadLike;
use App\Models\UserUploadFavourite;
use App\Http\Resources\UserUploadFavouriteResource;

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
    public function store(StoreUploadRequest $request)
    {
        
        $validated= $request->validated();

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);
        $upload = new Upload();
        $upload->name = $request->name;
        $upload->path = 'images/'.$imageName;
        $upload->type = $request->type;
        $upload->size = $request->size;
        $upload->user_id = $request->user_id;
        $upload->save();

        return response()->json([
            'message' => 'Upload created successfully',
            'data' => new UploadResource($upload)
        ], 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(Upload $upload)
    {
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

    public function discover()
    {
        $uploads = Upload::all();
        return UploadResource::collection($uploads);
    }  
    
    public function like(Upload $upload)
    {
        $upload->likes++;
        $upload->save();
        $user_id = auth()->user()->id;
        $upload_id = $upload->id;
        $userUploadLike = new UserUploadLike( ['user_id' => $user_id, 'upload_id' => $upload_id]);
        $userUploadLike->save();
        return response()->json([
            'message' => 'Upload like successfully',
            'data' => new UploadResource($upload)
        ], 200);
    }

    public function dislike(Upload $upload)
    {
        $upload->likes--;
        $upload->save();
        $user_id = auth()->user()->id;
        $upload_id = $upload->id;
        $userUploadLike = UserUploadLike::where('user_id', $user_id)->where('upload_id', $upload_id)->first();
        $userUploadLike->delete();

        return response()->json([
            'message' => 'Upload dislike successfully',
            'data' => new UploadResource($upload)
        ], 200);
    }


    public function favourite(Upload $upload)
    {
        $upload->saves++;
        $upload->save();
        $user_id = auth()->user()->id;
        $upload_id = $upload->id;
        $userUploadFavourite = new UserUploadFavourite( ['user_id' => $user_id, 'upload_id' => $upload_id]);
        $userUploadFavourite->save();
        return response()->json([
            'message' => 'Upload favourite successfully',
            'data' => new UploadResource($upload)
        ], 200);
    }

    public function unfavourite(Upload $upload)
    {
        $upload->saves--;
        $upload->save();
        $user_id = auth()->user()->id;
        $upload_id = $upload->id;
        $userUploadFavourite = UserUploadFavourite::where('user_id', $user_id)->where('upload_id', $upload_id)->first();
        $userUploadFavourite->delete();

        return response()->json([
            'message' => 'Upload unfavourite successfully',
            'data' => new UploadResource($upload)
        ], 200);
    }

    public function getAllFavourites()
    {
        $user_id = auth()->user()->id;
        $userUploadFavourites = UserUploadFavourite::where('user_id', $user_id)->get();
        $upload_ids = $userUploadFavourites->pluck('upload_id');
        return UserUploadFavouriteResource::collection($userUploadFavourites);
    }


}
