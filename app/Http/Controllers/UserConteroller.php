<?php

namespace App\Http\Controllers;

use App\Exceptions\PlaylistSongNotAuthorizedException;
use App\Http\Controllers\Base\PlaylistSongBaseController;
use App\Model\User;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserController extends PlaylistSongBaseController
{
     /** fungsi untuk mengambil semua data user
     * 
     */
    public function getAllUser()
    {

        $user = User::all();
        return $this->successResponse(['users'=>$user]);
    }

    public function getByUserId($id)
    {
        $user  = User::find($id);
        if ($user === null) {
           throw new NotFoundHttpException();
        }
        return $this->successResponse(['user'=>$user]);
    }

    public function create()
    {
        /* validasi */ 
        $validasi = Validator::make(request()->all(),[
            'email' => 'required',
            'password' =>'required',
            'api_token' => 'required',
            'role' => 'required',
            'fullname' => 'required' 
        ]);
        if ($validasi->fails()) {
            return $this->failedResponse($validasi->errors()->getMessages(),400);
        }
        $user = new User();
        $user->email = request('email');
        $user->password = request('password');
        $user->api_token = request('api_token');
        $user->role = request('role');
        $user->fullname = request('fullname');
        $user->save();
        return $this->successResponse(['user'=>$user]);
    }
    
    public function update($id)
    {
        $user = User::find($id);
        $validasi = Validator::make(request()->all(),[
            'email' => 'required',
            'password' =>'required',
            'api_token' => 'required',
            'role' => 'required',
            'fullname' => 'required' 
        ]);
        if ($validasi->fails()) {
            return $this->failedResponse($validasi->errors()->getMessages(),400);
        }
        $user->email = request('email');
        $user->password = request('password');
        $user->api_token = request('api_token');
        $user->role = request('role');
        $user->fullname = request('fullname');
        $user->save();
        return $this->successResponse(['user'=>$user]);
    }

    public function delete($id)
    {
        $user = User::find($id);
        if ($user === null ) {
        throw new NotFoundHttpException(); 
        }
        $user->delete();
        return $this->successResponse(['user'=>'user has been deleted successfully']);
    }

}