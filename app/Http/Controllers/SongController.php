<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Base\PlaylistSongBaseController;
use App\Model\Song;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SongController extends PlaylistSongBaseController
{
    /** fungsi untuk mengambil semua data songs
     * 
     */
    public function getAllSong()
    {

        $songs = Song::all();
        return $this->successResponse(['songs'=>$songs]);
    }

    /** fungsi mengambil satu data dari song
     * @param $id
     * @return jsonresponse
     * */

    public function getByIdSong($id)
    {
        $song = Song::find($id);
        if ($song === null) {
            throw new NotFoundHttpException();
        }
        return  $this->successResponse(['song'=>$song]);
    }

    public function createSong()
    {
        /* validasi */ 
        $validate = Validator::make(request()->all(),[
            'title'=> 'required',
            'year'=> 'required|numeric',
            'artist'=> 'required',
            'gendre'=> 'required',
            'duration'=> 'required'
        ]);
        if ($validate->fails()) {
            return $this->failedResponse($validate->errors()->getMessages(),400);
        }
        // jika tidak ada error yang terjadi
        $song = new Song();
        $song->title = request('title');
        $song->year = request('year');
        $song->artist = request('artist');
        $song->gendre = request('gendre');
        $song->duration = request('duration');
        $song->save();
        return $this->successResponse(['song'=>$song],201);
    }

    /** fungsi mendapatkan satu data dari song untuk di lakukan perubahan 
     * @param $id
     * @return jsonresponse
     * */

    public function updateSong($id)
    {
        $song = Song::find($id);
        if ($song === null) {
            throw new NotFoundHttpException();
        }
        /* validasi */ 
        $validate = Validator::make(request()->all(),[
            'title'=> 'required',
            'year'=> 'required|numeric',
            'artist'=> 'required',
            'gendre'=> 'required',
            'duration'=> 'required'
        ]);
        if ($validate->fails()) {
            return $this->failedResponse($validate->errors()->getMessages(),400);
        }
        $song->title = request('title');
        $song->year = request('year');
        $song->artist = request('artist');
        $song->gendre = request('gendre');
        $song->duration = request('duration');
        $song->save();
        return $this->successResponse(['song'=>$song]);;
    }

    public function deleteSong($id)
    {
        $song = Song::find($id);
        if ($song === null) {
            throw new NotFoundHttpException();
        }
        $song->delete();
        return $this->successResponse(['song'=>'Song has been deleted successfully']);;
    }
}