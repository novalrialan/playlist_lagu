<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Base\PlaylistSongBaseController;
use App\Model\PlaylistSong;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PlaylistSongController extends PlaylistSongBaseController
{
  /** fungsi untuk mengambil semua data playlistsongs
     * 
     */
    public function getAllPlaylistSong()
    {

        $playlistsongs = PlaylistSong::all();
        return $this->successResponse(['playlistsongs'=>$playlistsongs]);
    }    
    
        /** fungsi mengambil satu data dari playlistsongs
     * @param $id
     * @return jsonresponse
     * */

    public function getByPlaylistSongId($id)
    {
        $playlistsongs = PlaylistSong::find($id);
        if ($playlistsongs === null) {
            throw new NotFoundHttpException();
        }
        return  $this->successResponse(['playlistsongs'=>$playlistsongs]);
    }
    
    public function create(){
        /* validasi */ 
        $validate = Validator::make(request()->all(),[
           'playlist_id'=> 'required',
           'song_id'=> 'required'
       ]);
       if ($validate->fails()) {
           return $this->failedResponse($validate->errors()->getMessages(),400);
       }
       $playlistsong = new PlaylistSong();
       $playlistsong->playlist_id = request('playlist_id');
       $playlistsong->song_id = request('song_id');
       $playlistsong->save();
       return $this->successResponse(['playlistsong'=>$playlistsong],201);
   }

   public function update($id)
    {
        $playlistsong = PlaylistSong::find($id);
        if ($playlistsong === null) {
            throw new NotFoundHttpException();
        }
         /* validasi */ 
         $validate = Validator::make(request()->all(),[
            'name'=> 'required',
            'user_id'=> 'required'
        ]);
        if ($validate->fails()) {
            return $this->failedResponse($validate->errors()->getMessages(),400);
        }
        $playlistsong = new PlaylistSong();
        $playlistsong->playlist_id = request('playlist_id');
        $playlistsong->song_id = request('song_id');
        $playlistsong->save();
        return $this->successResponse(['playlistsong'=>$playlistsong],201);
    }
    
    public function delete($id)
    {
        $playlistsong = PlaylistSong::find($id);
        if ($playlistsong === null) {
            throw new NotFoundHttpException();
        }
        $playlistsong->delete();
        return $this->successResponse(['playlistsong'=>'playlistsong has been deleted successfully']);;
    }
   
}