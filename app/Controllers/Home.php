<?php


namespace App\Controllers;

use App\Models\Song;
use App\Models\Concert;
use App\Models\Performance;

class Home extends BaseController
{

    public function index()
    {
        $performanceModel = new Performance();
        $concertModel = new Concert();
        $songModel = new Song();

        $builder = $performanceModel
            ->select('performances.order, concerts.name as concert_name, concerts.location as concert_location, concerts.date as concert_date, songs.title as song_title')
            ->join('concerts', 'concerts.id = performances.concert_id')
            ->join('songs', 'songs.id = performances.song_id')
            ->orderBy('concerts.date', 'DESC')
            ->orderBy('performances.order', 'ASC');

        $performances = $builder->findAll();

        $db = \Config\Database::connect();

        $mostPlayedSong = $db->table('performances')
            ->select('songs.title, COUNT(*) as count')
            ->join('songs', 'songs.id = performances.song_id')
            ->groupBy('songs.title') 
            ->orderBy('count', 'DESC')
            ->limit(1)
            ->get()
            ->getRowArray();


        $topConcert = $db->table('performances')
            ->select('concerts.name, COUNT(*) as count')
            ->join('concerts', 'concerts.id = performances.concert_id')
            ->groupBy('concerts.name')
            ->orderBy('count', 'DESC')
            ->limit(1)
            ->get()
            ->getRowArray();

        $data = [
            'performances' => $performances,
            'mostPlayedSong' => $mostPlayedSong['title'] ?? null,
            'topConcert' => $topConcert['name'] ?? null,
            'totalSongs' => $songModel->countAll(),
            'totalConcerts' => $concertModel->countAll()
        ];

        return view('home', $data);
    }



}
