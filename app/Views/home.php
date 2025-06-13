<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Miku Concert Tracker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --miku: #39C5BB;
            --light-bg: #f0fdfd;
            --text: #333;
        }
        body {
            background-color: var(--light-bg);
            color: var(--text);
        }
        header {
            background: var(--miku);
        }
        .btn-miku {
            background: white;
            color: var(--miku);
            border: none;
        }
        .btn-miku:hover {
            background: #e9ecef;
            color: #2aa8a0;
        }
        .bg-miku {
            background-color: var(--miku);
            color: white;
        }
        .card-miku .card-header {
            background-color: var(--miku);
            color: white;
        }
        .card-miku strong {
            color: var(--miku);
        }
    </style>
</head>
<body>
    <header class="d-flex justify-content-between align-items-center p-3 text-white">
        <h1 class="m-0">🎤 Miku Tracker</h1>
        <a class="btn btn-miku" href="/contribute">+ Contribute</a>
    </header>

    <div class="container my-4">
        <div class="row">
            <div class="col-lg-8 col-12 mb-4">
                <div class="card">
                    <div class="card-header bg-miku">
                        <h2 class="m-0">Concerts & Songs</h2>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="bg-miku">
                                        <th>Concert</th>
                                        <th>Location</th>
                                        <th>Date</th>
                                        <th>Song Title</th>
                                        <th>Order</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($performances as $item): ?>
                                        <tr>
                                            <td><?= esc($item['concert_name']) ?></td>
                                            <td><?= esc($item['concert_location']) ?></td>
                                            <td><?= esc($item['concert_date']) ?></td>
                                            <td><?= esc($item['song_title']) ?></td>
                                            <td><?= esc($item['order']) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-12">
                <div class="card card-miku">
                    <div class="card-header">
                        <h2 class="m-0">Statistics</h2>
                    </div>
                    <div class="card-body">
                        <div class="card mb-3">
                            <div class="card-body">
                                <strong>Most Played Song</strong>
                                <p class="card-text"><?= esc($mostPlayedSong ?? '-') ?></p>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <strong>Concert with Most Songs</strong>
                                <p class="card-text"><?= esc($topConcert ?? '-') ?></p>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <strong>Total Songs</strong>
                                <p class="card-text"><?= esc($totalSongs) ?></p>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <strong>Total Concerts</strong>
                                <p class="card-text"><?= esc($totalConcerts) ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>