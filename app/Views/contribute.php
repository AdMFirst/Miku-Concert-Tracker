<!DOCTYPE html>
<html>
<head>
    <title>Contribute</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 20px;
            background: #f0f8ff;
            color: #333;
        }

        h1 {
            color: #00bcd4;
            text-align: center;
            margin-bottom: 40px;
        }

        section {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 188, 212, 0.2);
            padding: 20px;
            margin-bottom: 40px;
        }

        h2 {
            color: #0097a7;
            margin-top: 0;
        }

        form {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            align-items: center;
            margin-bottom: 10px;
        }

        form input, form select, form button {
            padding: 8px 12px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        form button {
            background: #00bcd4;
            color: white;
            border: none;
            cursor: pointer;
            transition: background 0.3s;
        }

        form button:hover {
            background: #0097a7;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        table th {
            background: #e0f7fa;
        }

        table td button {
            background: #00796b;
            color: white;
            border: none;
            padding: 5px 10px;
            margin: 0 2px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 13px;
        }

        table td button:hover {
            background: #004d40;
        }
    </style>
</head>
<body>

<h1>Contribute to Miku Concert Tracker Database</h1>

<!-- Concerts Section -->
<section>
    <h2>Concerts</h2>
    <form id="concertForm">
        <input type="hidden" name="id">
        <input type="hidden" name="type" value="concert">
        <input name="name" placeholder="Name" required>
        <input name="location" placeholder="Location" required>
        <input name="date" type="date" required>
        <button>Save</button>
    </form>

    <table>
        <tr><th>Name</th><th>Location</th><th>Date</th><th>Actions</th></tr>
        <?php foreach ($concerts as $c): ?>
        <tr data-id="<?= $c['id'] ?>">
            <td><?= esc($c['name']) ?></td>
            <td><?= esc($c['location']) ?></td>
            <td><?= esc($c['date']) ?></td>
            <td>
                <button onclick="editForm('concert', <?= $c['id'] ?>, <?= htmlspecialchars(json_encode($c)) ?>)">Edit</button>
                <button onclick="deleteItem('concert', <?= $c['id'] ?>)">Delete</button>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</section>

<!-- Songs Section -->
<section>
    <h2>Songs</h2>
    <form id="songForm">
        <input type="hidden" name="id">
        <input type="hidden" name="type" value="song">
        <input name="title" placeholder="Title" required>
        <input name="writer" placeholder="Writer" required>
        <button>Save</button>
    </form>

    <table>
        <tr><th>Title</th><th>Writer</th><th>Actions</th></tr>
        <?php foreach ($songs as $s): ?>
        <tr data-id="<?= $s['id'] ?>">
            <td><?= esc($s['title']) ?></td>
            <td><?= esc($s['writer']) ?></td>
            <td>
                <button onclick="editForm('song', <?= $s['id'] ?>, <?= htmlspecialchars(json_encode($s)) ?>)">Edit</button>
                <button onclick="deleteItem('song', <?= $s['id'] ?>)">Delete</button>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</section>

<!-- Performances Section -->
<section>
    <h2>Performances</h2>
    <form id="performanceForm">
        <input type="hidden" name="concert_id_old">
        <input type="hidden" name="song_id_old">
        <input type="hidden" name="type" value="performance">

        <select name="concert_id" required>
            <option value="">-- Select Concert --</option>
            <?php foreach ($concerts as $c): ?>
            <option value="<?= $c['id'] ?>"><?= esc($c['name']) ?></option>
            <?php endforeach; ?>
        </select>

        <select name="song_id" required>
            <option value="">-- Select Song --</option>
            <?php foreach ($songs as $s): ?>
            <option value="<?= $s['id'] ?>"><?= esc($s['title']) ?></option>
            <?php endforeach; ?>
        </select>

        <input name="order" type="number" placeholder="Order" required>
        <button>Save</button>
    </form>

    <table>
        <tr><th>Concert ID</th><th>Song ID</th><th>Order</th><th>Actions</th></tr>
        <?php foreach ($performances as $p): ?>
        <tr data-id="<?= $p['concert_id'] ?>-<?= $p['song_id'] ?>">
            <td><?= esc($p['concert_id']) ?></td>
            <td><?= esc($p['song_id']) ?></td>
            <td><?= esc($p['order']) ?></td>
            <td>
                <button onclick="editForm('performance', '<?= $p['concert_id'] ?>', '<?= $p['song_id'] ?>', <?= htmlspecialchars(json_encode($p)) ?>)">Edit</button>
                <button onclick="deleteItem('performance', '<?= $p['concert_id'] ?>', '<?= $p['song_id'] ?>')">Delete</button>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</section>

<script>
function editForm(type, id1, id2 = null, data = {}) {
    const form = $(`#${type}Form`);
    if (type === 'performance') {
        form.find('[name=concert_id]').val(data.concert_id);
        form.find('[name=song_id]').val(data.song_id);
        form.find('[name=concert_id_old]').val(id1);
        form.find('[name=song_id_old]').val(id2);
        form.find('[name=order]').val(data.order);
    } else {
        form.find('[name=id]').val(id1);
        for (const key in data) {
            form.find(`[name=${key}]`).val(data[key]);
        }
    }
}

$('form').on('submit', function(e) {
    e.preventDefault();
    $.post('/contribute/save', $(this).serialize(), () => location.reload());
});

function deleteItem(type, id1, id2 = null) {
    if (confirm('Delete?')) {
        const data = { type };
        if (type === 'performance') {
            data.concert_id = id1;
            data.song_id = id2;
        } else {
            data.id = id1;
        }
        $.post('/contribute/delete', data, () => location.reload());
    }
}
</script>

</body>
</html>
