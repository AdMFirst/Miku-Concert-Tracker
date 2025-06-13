<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Miku Concert Tracker</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        :root {
            --miku: #39C5BB;
            --light-bg: #f0fdfd;
            --text: #333;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
            color: var(--text);
            background-color: #fff;
        }

        header {
            background: var(--miku);
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
        }

        header h1 {
            margin: 0;
            font-weight: bold;
        }

        header a.button {
            background: white;
            color: var(--miku);
            padding: 0.5rem 1rem;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            padding: 2rem;
        }

        .table-panel {
            flex: 2;
            min-width: 300px;
        }

        .stats-panel {
            flex: 1;
            min-width: 250px;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        table th, table td {
            border: 1px solid #ccc;
            padding: 0.75rem;
            text-align: left;
        }

        table th {
            background-color: #f0f0f0;
        }

        .stat-card {
            background-color: var(--light-bg);
            padding: 1rem;
            border-radius: 12px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        }

        .stat-card strong {
            color: var(--miku);
            display: block;
            margin-bottom: 0.5rem;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>

<header>
    <h1>🎤 Miku Tracker</h1>
    <a class="button" href="/contribute">+ Contribute</a>
</header>

<div class="container">

    <div class="table-panel">
        <h2>Concerts & Songs</h2>
        <table>
            <thead>
                <tr>
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


    <div class="stats-panel">
        <div class="stat-card">
            <strong>Most Played Song</strong>
            <?= esc($mostPlayedSong ?? '-') ?>
        </div>

        <div class="stat-card">
            <strong>Concert with Most Songs</strong>
            <?= esc($topConcert ?? '-') ?>
        </div>

        <div class="stat-card">
            <strong>Total Songs</strong>
            <?= esc($totalSongs) ?>
        </div>

        <div class="stat-card">
            <strong>Total Concerts</strong>
            <?= esc($totalConcerts) ?>
        </div>
    </div>
</div>

</body>
</html>
