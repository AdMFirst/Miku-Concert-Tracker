<?php

namespace App\Controllers;

use App\Models\Concert;
use App\Models\Song;
use App\Models\Performance;
use CodeIgniter\Controller;

class Contribute extends Controller
{
    public function index()
    {
        $concerts = model(Concert::class)->findAll();
        $songs = model(Song::class)->findAll();
        $performances = model(Performance::class)->findAll();
        
        return view('contribute', compact('concerts', 'songs', 'performances'));
    }

    public function save()
    {
        $type = $this->request->getPost('type');
        $id = $this->request->getPost('id');

        switch ($type) {
            case 'concert':
                $model = model(Concert::class);
                $data = $this->request->getPost(['name', 'location', 'date']);
                break;
            case 'song':
                $model = model(Song::class);
                $data = $this->request->getPost(['title', 'writer']);
                break;
            case 'performance':
                $model = model(Performance::class);
                $data = $this->request->getPost(['concert_id', 'song_id', 'order']);
                break;
            default:
                return $this->response->setJSON(['status' => 'error', 'message' => 'Unknown type']);
        }

        if ($id) {
            $model->update($id, $data);
        } else {
            $model->insert($data);
        }

        return $this->response->setJSON(['status' => 'ok']);
    }

    public function delete()
    {
        $type = $this->request->getPost('type');
        $id = $this->request->getPost('id');

        $model = match ($type) {
            'concert' => model(Concert::class),
            'song' => model(Song::class),
            'performance' => model(Performance::class),
            default => null
        };

        if (!$model) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid model']);
        }

        $model->delete($id);

        return $this->response->setJSON(['status' => 'deleted']);
    }
}
