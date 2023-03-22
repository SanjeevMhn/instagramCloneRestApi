<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Posts;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return response()->json([
            'status' => true,
            'users' => $users
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->hasFile('profile_img')){
            $validate = Validator::make($request->all(), [
                'profile_img' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);

            if($validate->fails()){
                return response()->json([
                    'errors' => $validate->errors()
                ]);
            }

            $userId = auth('sanctum')->user()->id;

            $uploadFolder = 'profilePic/' . $userId;

            $image = $request->file('profile_img');
            $imageUploadPath = $image->store($uploadFolder,'public');

            $updatedUser = User::find($userId);
            $updatedUser->profile_img = 'storage/' . $imageUploadPath;
            $updatedUser->update();

            return response()->json([
                'message' => 'Profile picture updated successfully',
                'user' => $updatedUser,
            ], 200);

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      
        $user = User::find($id);

        if(!$user){
            return response()->json([
                'error' => 'User not found'
            ],404);
        }

        $posts = Posts::where('posts.user_id', '=', $id)->orderBy('posts.updated_at','desc')->get(); 

        return response()->json([
            'status' => true,
            'user' => $user,
            'posts' => $posts
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
