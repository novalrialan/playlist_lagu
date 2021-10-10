<?php 


namespace App\Http\Controllers;

use App\Http\Controllers\Base\PlaylistSongBaseController;
use App\Model\Playlist;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PlaylistController extends PlaylistSongBaseController 
{
     /** fungsi untuk mengambil semua data playlists
     * 
     */
    public function getAllPlaylist()
    {

        $playlits = Playlist::all();
        return $this->successResponse(['playlits'=>$playlits]);
    }
    
    /** fungsi mengambil satu data dari playlist
     * @param $id
     * @return jsonresponse
     * */

    public function getByPlayistId($id)
    {
        $playlist = Playlist::find($id);
        if ($playlist === null) {
            throw new NotFoundHttpException();
        }
        return  $this->successResponse(['playlist'=>$playlist]);
    }

    public function create(){
         /* validasi */ 
         $validate = Validator::make(request()->all(),[
            'name'=> 'required',
            'user_id'=> 'required|numeric'
        ]);
        if ($validate->fails()) {
            return $this->failedResponse($validate->errors()->getMessages(),400);
        }
        $playlist = new Playlist();
        $playlist->name = request('name');
        $playlist->user_id = request('user_id');
        $playlist->save();
        return $this->successResponse(['playlist'=>$playlist],201);
    }

    public function update($id)
    {
        $playlist = Playlist::find($id);
        if ($playlist === null) {
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
        $playlist = new Playlist();
        $playlist->name = request('name');
        $playlist->user_id = request('user_id');
        $playlist->save();
        return $this->successResponse(['playlist'=>$playlist],201);
    }

    public function delete($id)
    {
        $playlist = Playlist::find($id);
        if ($playlist === null) {
            throw new NotFoundHttpException();
        }
        $playlist->delete();
        return $this->successResponse(['playlist'=>'playlist has been deleted successfully']);;
    }
}