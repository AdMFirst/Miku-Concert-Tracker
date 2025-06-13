<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contribute</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        :root {
            --miku: #39C5BB;
            --light-bg: #f0fdfd;
            --text: #333;
        }
        body {
            background-color: var(--light-bg);
            font-family: 'Inter', sans-serif;
            color: var(--text);
        }
        .container {
            max-width: 1200px;
            padding: 20px;
        }
        h1 {
            color: var(--miku);
            text-align: center;
            font-weight: 700;
            margin-bottom: 10px;
        }
        .return-link {
            text-align: center;
            margin-bottom: 30px;
        }
        .return-link a {
            color: var(--miku);
            text-decoration: none;
            font-size: 1.1em;
        }
        .return-link a:hover {
            text-decoration: underline;
        }
        .section {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 30px;
            padding: 20px;
        }
        .section h2 {
            color: var(--miku);
            font-weight: 600;
            margin-bottom: 20px;
        }
        .table {
            border-radius: 8px;
            overflow: hidden;
        }
        .table th {
            background-color: var(--miku);
            color: white;
            text-align: left;
        }
        .table td {
            vertical-align: middle;
        }
        .form-section {
            margin-top: 20px;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 8px;
        }
        .form-section h4 {
            color: var(--miku);
            margin-bottom: 15px;
        }
        .btn-primary {
            background-color: var(--miku);
            border-color: var(--miku);
        }
        .btn-primary:hover {
            background-color: #2aa8a0;
            border-color: #2aa8a0;
        }
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }
        .error {
            color: #dc3545;
            font-size: 0.9em;
            margin-top: 10px;
        }
        .form-control, .form-select {
            border-radius: 6px;
            color: var(--text);
        }
        .btn-sm {
            padding: 5px 10px;
            font-size: 0.85em;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Contribute to Miku Tracker Database</h1>
        <p class="return-link"><a href="/">&lt; Return</a></p>

        <!-- Concerts Section -->
        <div class="section">
            <h2>Concerts</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Location</th>
                        <th>Date</th>
                        <th>Details</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="concerts-table">
                    <?php foreach ($concerts as $concert): ?>
                        <tr data-id="<?= $concert['id'] ?>">
                            <td><?= $concert['id'] ?></td>
                            <td><?= esc($concert['name']) ?></td>
                            <td><?= esc($concert['location']) ?></td>
                            <td><?= esc($concert['date']) ?></td>
                            <td><?= esc($concert['other_details'] ?? '') ?></td>
                            <td>
                                <button class="btn btn-sm btn-primary edit-concert">Edit</button>
                                <button class="btn btn-sm btn-danger delete-concert">Delete</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="form-section">
                <h4>Add/Edit Concert</h4>
                <form id="concert-form">
                    <input type="hidden" name="type" value="concert">
                    <input type="hidden" name="id" id="concert-id">
                    <div class="mb-3">
                        <label for="concert-name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="concert-name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="concert-location" class="form-label">Location</label>
                        <input type="text" class="form-control" id="concert-location" name="location" required>
                    </div>
                    <div class="mb-3">
                        <label for="concert-date" class="form-label">Date</label>
                    <input type="date" class="form-control" id="concert-date" name="date" required>
                    </div>
                    <div class="mb-3">
                        <label for="concert-details" class="form-label">Other Details</label>
                        <textarea class="form-control" id="concert-details" name="other_details"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Save</button>
                    <button type="button" class="btn btn-secondary clear-concert-form">Clear</button>
                    <div id="concert-error" class="error"></div>
                </form>
            </div>
        </div>

        <!-- Songs Section -->
        <div class="section">
            <h2>Songs</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Writer</th>
                        <th>Composer</th>
                        <th>Duration</th>
                        <th>Notes</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="songs-table">
                    <?php foreach ($songs as $song): ?>
                        <tr data-id="<?= $song['id'] ?>">
                            <td><?= $song['id'] ?></td>
                            <td><?= esc($song['title']) ?></td>
                            <td><?= esc($song['writer'] ?? '') ?></td>
                            <td><?= esc($song['composer'] ?? '') ?></td>
                            <td><?= esc($song['duration'] ?? '') ?></td>
                            <td><?= esc($song['notes'] ?? '') ?></td>
                            <td>
                                <button class="btn btn-sm btn-primary edit-song">Edit</button>
                                <button class="btn btn-sm btn-danger delete-song">Delete</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="form-section">
                <h4>Add/Edit Song</h4>
                <form id="song-form">
                    <input type="hidden" name="type" value="song">
                    <input type="hidden" name="id" id="song-id">
                    <div class="mb-3">
                        <label for="song-title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="song-title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="song-writer" class="form-label">Writer</label>
                        <input type="text" class="form-control" id="song-writer" name="writer">
                    </div>
                    <div class="mb-3">
                        <label for="song-composer" class="form-label">Composer</label>
                        <input type="text" class="form-control" id="song-composer" name="composer">
                    </div>
                    <div class="mb-3">
                        <label for="song-duration" class="form-label">Duration</label>
                        <input type="time" class="form-control" id="song-duration" name="duration">
                    </div>
                    <div class="mb-3">
                        <label for="song-notes" class="form-label">Notes</label>
                        <textarea class="form-control" id="song-notes" name="notes"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Save</button>
                    <button type="button" class="btn btn-secondary clear-song-form">Clear</button>
                    <div id="song-error" class="error"></div>
                </form>
            </div>
        </div>

        <!-- Performances Section -->
        <div class="section">
            <h2>Performances</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Concert</th>
                        <th>Song</th>
                        <th>Order</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="performances-table">
                    <?php foreach ($performances as $performance): ?>
                        <?php
                            $concert = array_filter($concerts, fn($c) => $c['id'] == $performance['concert_id']);
                            $concert = reset($concert);
                            $song = array_filter($songs, fn($s) => $s['id'] == $performance['song_id']);
                            $song = reset($song);
                        ?>
                        <tr data-id="<?= $performance['id'] ?>">
                            <td><?= $performance['id'] ?></td>
                            <td><?= esc($concert['name'] ?? 'Unknown') ?></td>
                            <td><?= esc($song['title'] ?? 'Unknown') ?></td>
                            <td><?= $performance['order'] ?></td>
                            <td>
                                <button class="btn btn-sm btn-primary edit-performance">Edit</button>
                                <button class="btn btn-sm btn-danger delete-performance">Delete</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="form-section">
                <h4>Add/Edit Performance</h4>
                <form id="performance-form">
                    <input type="hidden" name="type" value="performance">
                    <input type="hidden" name="id" id="performance-id">
                    <div class="mb-3">
                        <label for="performance-concert-id" class="form-label">Concert</label>
                        <select class="form-select" id="performance-concert-id" name="concert_id" required>
                            <option value="">Select Concert</option>
                            <?php foreach ($concerts as $concert): ?>
                                <option value="<?= $concert['id'] ?>"><?= esc($concert['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="performance-song-id" class="form-label">Song</label>
                        <select class="form-select" id="performance-song-id" name="song_id" required>
                            <option value="">Select Song</option>
                            <?php foreach ($songs as $song): ?>
                                <option value="<?= $song['id'] ?>"><?= esc($song['title']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="performance-order" class="form-label">Order</label>
                        <input type="number" class="form-control" id="performance-order" name="order" required>
                    </div>
                    <button type="submit" class="btn btn-success">Save</button>
                    <button type="button" class="btn btn-secondary clear-performance-form">Clear</button>
                    <div id="performance-error" class="error"></div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Handle form submissions
            $('#concert-form').submit(function(e) {
                e.preventDefault();
                saveData('concert', $(this));
            });

            $('#song-form').submit(function(e) {
                e.preventDefault();
                saveData('song', $(this));
            });

            $('#performance-form').submit(function(e) {
                e.preventDefault();
                saveData('performance', $(this));
            });

            // Handle edit buttons
            $(document).on('click', '.edit-concert', function() {
                const row = $(this).closest('tr');
                $('#concert-id').val(row.data('id'));
                $('#concert-name').val(row.find('td:eq(1)').text());
                $('#concert-location').val(row.find('td:eq(2)').text());
                $('#concert-date').val(row.find('td:eq(3)').text());
                $('#concert-details').val(row.find('td:eq(4)').text());
                $('#concert-error').text('');
            });

            $(document).on('click', '.edit-song', function() {
                const row = $(this).closest('tr');
                $('#song-id').val(row.data('id'));
                $('#song-title').val(row.find('td:eq(1)').text());
                $('#song-writer').val(row.find('td:eq(2)').text());
                $('#song-composer').val(row.find('td:eq(3)').text());
                $('#song-duration').val(row.find('td:eq(4)').text());
                $('#song-notes').val(row.find('td:eq(5)').text());
                $('#song-error').text('');
            });

            $(document).on('click', '.edit-performance', function() {
                const row = $(this).closest('tr');
                $('#performance-id').val(row.data('id'));
                $('#performance-concert-id').val($('option', '#performance-concert-id').filter(function() {
                    return $(this).text() === row.find('td:eq(1)').text();
                }).val());
                $('#performance-song-id').val($('option', '#performance-song-id').filter(function() {
                    return $(this).text() === row.find('td:eq(2)').text();
                }).val());
                $('#performance-order').val(row.find('td:eq(3)').text());
                $('#performance-error').text('');
            });

            // Handle delete buttons
            $(document).on('click', '.delete-concert', function() {
                deleteData('concert', $(this).closest('tr').data('id'), '#concerts-table');
            });

            $(document).on('click', '.delete-song', function() {
                deleteData('song', $(this).closest('tr').data('id'), '#songs-table');
            });

            $(document).on('click', '.delete-performance', function() {
                deleteData('performance', $(this).closest('tr').data('id'), '#performances-table');
            });

            // Handle clear buttons
            $('.clear-concert-form').click(function() {
                $('#concert-form')[0].reset();
                $('#concert-id').val('');
                $('#concert-error').text('');
            });

            $('.clear-song-form').click(function() {
                $('#song-form')[0].reset();
                $('#song-id').val('');
                $('#song-error').text('');
            });

            $('.clear-performance-form').click(function() {
                $('#performance-form')[0].reset();
                $('#performance-id').val('');
                $('#performance-error').text('');
            });

            // Save data via AJAX
            function saveData(type, form) {
                $.ajax({
                    url: '<?= base_url('contribute/save') ?>',
                    type: 'POST',
                    data: form.serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'ok') {
                            alert(type.charAt(0).toUpperCase() + type.slice(1) + ' saved successfully!');
                            location.reload();
                        } else {
                            $('#' + type + '-error').text(response.message || 'Error saving data');
                        }
                    },
                    error: function() {
                        $('#' + type + '-error').text('Server error');
                    }
                });
            }

            // Delete data via AJAX
            function deleteData(type, id, tableId) {
                if (confirm('Are you sure you want to delete this ' + type + '?')) {
                    $.ajax({
                        url: '<?= base_url('contribute/delete') ?>',
                        type: 'POST',
                        data: { type: type, id: id },
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 'deleted') {
                                alert(type.charAt(0).toUpperCase() + type.slice(1) + ' deleted successfully!');
                                $(tableId + ' tr[data-id="' + id + '"]').remove();
                            } else {
                                alert(response.message || 'Error deleting ' + type);
                            }
                        },
                        error: function() {
                            alert('Server error');
                        }
                    });
                }
            }
        });
    </script>
</body>
</html>