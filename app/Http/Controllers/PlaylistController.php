<?php 


namespace App\Http\Controllers;

use App\Http\Controllers\Base\PlaylistSongBaseController;
use App\Model\Playlist;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PlaylistController extends PlaylistSongBaseController 
{
     /** fungsi untuk mengambil semua data playlists
     * 
     */
    public function getAllName()
    {

        $playlits = Playlist::all();
        return $this->successResponse(['playlits'=>$playlits]);
    }
    
    /** fungsi mengambil satu data dari playlist
     * @param $id
     * @return jsonresponse
     * */

    public function getByUserId($id)
    {
        $playlist = Playlist::find($id);
        if ($playlist === null) {
            throw new NotFoundHttpException();
        }
        return  $this->successResponse(['playlist'=>$playlist]);
    }
}