<?php

namespace App\Http\Controllers;

use App\Model\Song;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SongController extends Controller
{
    /** fungsi untuk mengambil semua data songs
     * 
     */
    public function getAll()
    {

        $songs = Song::all();
        return $this->successResponse(['songs'=>$songs]);
    }

    /** fungsi mengambil satu data dari song
     * @param $id
     * @return jsonresponse
     * */

    public function getById($id)
    {
        $song = Song::find($id);
        if ($song === null) {
            throw new NotFoundHttpException();
        }
        return  $this->successResponse(['song'=>$song]);
    }

    public function create()
    {
        /* validasi */ 
        $validate = Validator::make(request()->all(),[
            'title'=> 'required',
            'year'=> 'required|numeric',
            'artist'=> 'required',
            'gendre'=> 'required',
            'duration'=> 'required|numeric'
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

    public function update($id)
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


    public function delete($id)
    {
        $song = Song::find($id);
        if ($song === null) {
            throw new NotFoundHttpException();
        }
        $song->delete();
        return $this->successResponse(['song'=>'Song has been deleted successfully']);;
    }
}