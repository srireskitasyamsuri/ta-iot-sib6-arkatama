<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('name','asc')->get();
        return response()->json([
            'message'   => 'Berhasil menampilkan data user',
            'data'      => $users
        ], 200);
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
        // membuat validasi
        $validated = $request->validate([
            'name'      => [
                'required',
                'string',
                'min:3',
                'max:255'
            ],
            'email'     => [
                'required',
                'email',
                'unique:users,email'
            ],
            'password'  => [
                'required',
                'min:8'
            ],
  //          'password_confirmation' => [
    //            'required',
      //          'same:password'
        //    ],
          //  'avatar' => [
           //     'nullable',
            //    'image',
             //   'mimes:jpg,jpeg,png',
              //  'max:2048' // 2 MB
            //]
        ]);

        // Unggah avatar
  //      if ($request->hasFile('avatar')) {
   //         $avatar = $request->file('avatar');
    //        $avatarPath = $avatar->store('avatars', 'public');
     //       $validated['avatar'] = $avatarPath;
      //  }

        // membuat user baru
        $users = User::create($validated);

        return response()->json([
            'message'   => 'Berhasil manambahkan user baru',
            'data'      => $users
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $users = User::find($id);
        return response()->json([
            'message'   => 'Berhasil menampilkan detail user',
            'data'      => $users
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name'      => [
                'required',
                'string',
                'min:3',
                'max:255'
            ],
            'email'     => [
                'required',
                'email',
                'unique:users,email,' .$id
            ],
            'password'  => [
                'nullable',
                'min:8'
            ],
  //         'password_confirmation' => [
   //             'required',
    //            'same:password'
    //         ],
    //       'avatar' => [
     //           'nullable',
       //         'image',
         //       'mimes:jpg,jpeg,png',
          //      'max:2048' // 2 MB
           // ]
        ]);

        // Unggah avatar
 //       if ($request->hasFile('avatar')) {
//            $avatar = $request->file('avatar');
  //          $avatarPath = $avatar->store('avatars', 'public');
   //         $validated['avatar'] = $avatarPath;
   //     }

        // jika ada password baru, maka update password
        if ($request->filled('password')) {
            $validated['password'] = bcrypt($validated['password']);
        }else{
            unset($validated['password']);
        }

        $users = User::find($id);
        $users->update($validated);

        return response()->json([
            'message'   => 'Berhasil mengupdate data user',
            'data'      => $users
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $users = User::find($id);
        $users->delete();

        return response()->json([
            'message'   => 'Berhasil menghapus data user',
            'data'      => $users
        ], 200);
    }
}
