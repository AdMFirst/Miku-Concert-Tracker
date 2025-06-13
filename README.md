
# Miku Concert Tracker

A simple web application to track Hatsune Miku concerts, songs, and performances, built with PHP CodeIgniter 4. Styled with a Miku-inspired theme, it allows users to view concert and song data, contribute new entries, and manage existing ones via a user-friendly interface.

## Features

-   **Home Page**: Displays a table of performances (concerts, locations, dates, songs, and order) and statistics (most played song, concert with most songs, total songs, total concerts).
-   **Contribute Page**: Provides CRUD functionality for:
    -   **Concerts**: Manage name, location, date, and details.
    -   **Songs**: Manage title, writer, composer, duration (time format), and notes.
    -   **Performances**: Link concerts and songs with an order number.


## Prerequisites

-   PHP 8.2+
-   Composer
-   Microsoft SQL Server (e.g., SQL Server Express 2019 or later)
-   SQL Server PHP drivers (Microsoft Drivers for PHP for SQL Server)
-   Web server (e.g., Apache, Nginx)
-   CodeIgniter 4 dependencies (installed via Composer)

## Installation

1.  **Clone the Repository**:
    
    ```bash
    git clone https://github.com/your-username/miku-concert-tracker.git
    cd miku-concert-tracker
    
    ```
    
2.  **Install Dependencies**:
    
    ```bash
    composer install
    
    ```
    
3.  **Install SQL Server PHP Drivers**:
    
    -   Download and install the Microsoft Drivers for PHP for SQL Server (e.g., `sqlsrv` and `pdo_sqlsrv`).
    -   For Windows, add the drivers to your PHP `ext` directory and update `php.ini`:
        
        ```ini
        extension=php_sqlsrv.dll
        extension=php_pdo_sqlsrv.dll
        
        ```
        
    -   For Linux, install via PECL:
        
        ```bash
        pecl install sqlsrv pdo_sqlsrv
        
        ```
        
        Add to `php.ini`:
        
        ```ini
        extension=sqlsrv.so
        extension=pdo_sqlsrv.so
        
        ```
        
    -   See [Microsoft Documentation](https://docs.microsoft.com/en-us/sql/connect/php/download-drivers-php-sql-server) for details.
4.  **Configure Environment**:
    
    -   Copy `env` to `.env`:
        
        ```bash
        cp env .env
        
        ```
        
    -   Update database settings in `.env` for SQL Server:
        
        ```env
        database.default.hostname = localhost
        database.default.database = miku_tracker
        database.default.username = your_username
        database.default.password = your_password
        database.default.DBDriver = SQLSRV
        database.default.port = 1433
        
        ```
        
5.  **Set Up Database**:
    
    -   Create a SQL Server database (e.g., `miku_tracker`) using SQL Server Management Studio or a similar tool.
    -   Run the following SQL to create tables:
        
        ```sql
        CREATE TABLE concerts (
            id INT IDENTITY(1,1) PRIMARY KEY,
            name NVARCHAR(255) NOT NULL,
            location NVARCHAR(255) NOT NULL,
            date DATE NOT NULL,
            other_details NVARCHAR(MAX)
        );
        
        CREATE TABLE songs (
            id INT IDENTITY(1,1) PRIMARY KEY,
            title NVARCHAR(255) NOT NULL,
            writer NVARCHAR(255),
            composer NVARCHAR(255),
            duration TIME,
            notes NVARCHAR(MAX)
        );
        
        CREATE TABLE performances (
            id INT IDENTITY(1,1) PRIMARY KEY,
            concert_id INT NOT NULL,
            song_id INT NOT NULL,
            order INT NOT NULL,
            CONSTRAINT FK_performances_concert FOREIGN KEY (concert_id) REFERENCES concerts(id) ON DELETE CASCADE,
            CONSTRAINT FK_performances_song FOREIGN KEY (song_id) REFERENCES songs(id) ON DELETE CASCADE
        );
        
        ```
        
6.  **Start the Server**:
    
    -   Use CodeIgniter's built-in server:
        
        ```bash
        php spark serve
        
        ```
        
    -   Or configure your web server to point to the `public` directory.
7.  **Access the App**:
    
    -   Open `http://localhost:8080` in a browser.

## UI Documentation

### Home Page (`/`)

-   **Overview**: Displays all performances and key statistics.
-   **UI Elements**:
    -   **Header**: Shows "🎤 Miku Tracker" and a "+ Contribute" button linking to `/contribute`.
    -   **Performance Table**: Lists concerts (name, location, date), song titles, and performance order.
    -   **Statistics Panel**: Shows:
        -   Most played song (or `-` if none).
        -   Concert with the most songs (or `-` if none).
        -   Total songs and concerts.
-   **Usage**:
    1.  View the performance table to see all concert-song pairings.
    2.  Check statistics for insights.
    3.  Click "+ Contribute" to add or edit data.

### Contribute Page (`/contribute`)

-   **Overview**: Allows CRUD operations for concerts, songs, and performances via three sections.
-   **UI Elements**:
    -   **Header**: Shows "Contribute to Miku Tracker Database" and a "Return" link to `/`.
    -   **Sections** (Concerts, Songs, Performances):
        -   **Tables**: Display all records with columns matching model fields (e.g., Concerts: ID, Name, Location, Date, Details).
        -   **Edit/Delete Buttons**: Each row has "Edit" (populates form) and "Delete" (confirms before deletion).
        -   **Forms**: Add or edit records with fields:
            -   Concerts: Name (required), Location (required), Date (required), Other Details.
            -   Songs: Title (required), Writer, Composer, Duration (`HH:MM:SS`), Notes.
            -   Performances: Concert (dropdown, required), Song (dropdown, required), Order (required).
        -   **Save/Clear Buttons**: "Save" submits via AJAX; "Clear" resets the form.
-   **Usage**:
    1.  View tables to see existing records.
    2.  Click "Edit" to populate the form with a record's data.
    3.  Fill or edit form fields and click "Save" to add/update (AJAX response shows success or error).
    4.  Click "Delete" to remove a record (confirmation required).
    5.  Click "Clear" to reset the form for a new entry.
    6.  Click "Return" to go back to the home page.

## Developer Documentation

### Project Structure

-   `app/Controllers/Contribute.php`: Handles CRUD for concerts, songs, and performances.
-   `app/Models/Concert.php`, `Song.php`, `Performance.php`: Define database models with allowed fields and no soft deletes.
-   `app/Views/index.php`: Home page with performance table and stats.
-   `app/Views/contribute.php`: Contribution page with tables and forms.
-   `public/`: Serves static assets.

### Database Schema

-   **Concerts**:
    -   `id`: `INT IDENTITY(1,1)` primary key (auto-incrementing).
    -   `name`, `location`: `NVARCHAR(255)` (required, Unicode support).
    -   `date`: `DATE` (required).
    -   `other_details`: `NVARCHAR(MAX)` (optional).
-   **Songs**:
    -   `id`: `INT IDENTITY(1,1)` primary key.
    -   `title`: `NVARCHAR(255)` (required).
    -   `writer`, `composer`: `NVARCHAR(255)` (optional).
    -   `duration`: `TIME` (optional, stores `HH:MM:SS`).
    -   `notes`: `NVARCHAR(MAX)` (optional).
-   **Performances**:
    -   `id`: `INT IDENTITY(1,1)` primary key.
    -   `concert_id`, `song_id`: `INT` foreign keys with `ON DELETE CASCADE`.
    -   `order`: `INT` (optional).
-   **Relationships**:
    -   A performance links one concert to one song via `concert_id` and `song_id`.
    -   `ON DELETE CASCADE` ensures deleting a concert or song removes related performances.


## Dependencies

-   **CodeIgniter 4**: PHP framework.
-   **Bootstrap 5.3.3**: Styling (CDN-hosted).
-   **jQuery 3.7.1**: AJAX handling in `contribute.php` (CDN-hosted).
-   **SQL Server PHP Drivers**: For database connectivity.

## Notes

-   **Duration**: The `songs.duration` column uses `TIME` for `HH:MM:SS`. If storing in seconds, modify the `save` method to convert input.    
-   **Performance**: Add pagination to the home page table for large datasets.
-   **Offline Use**: Host Bootstrap and jQuery locally if needed.
-   **SQL Server**: Ensure the SQL Server instance is accessible and the PHP drivers are correctly configured.

## License
GNU General Public License v3.0. See LICENSE for details.

----------

Built with 💙 for Hatsune Miku fans!