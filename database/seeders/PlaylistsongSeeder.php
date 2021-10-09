<?php

namespace App\database\seeder;

use App\Model\Song;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Database\Seeder;


class PlaylistsongSeeder extends Seeder
{
public function run()
    {
    $songs = Factory(Song::class,10)->create();
    }    
}