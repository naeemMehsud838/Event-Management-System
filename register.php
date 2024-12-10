<?php
// Include your existing database connection file (db.php)
include('db.php');

// Fetch events from the database using PDO
$events_query = "SELECT * FROM events"; // Ensure this matches your table name

// Execute the query using PDO
$events_result = $conn->query($events_query);

// Check if the query was successful
if (!$events_result) {
    die('Error fetching events: ' . $conn->errorInfo());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register for Events</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <header>
        <h1>Register for an Event</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="register.php">Register</a></li>
                <li><a href="events.php">View Events</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="register-container">
            <h2>Select Event to Register</h2>

            <!-- Registration Form -->
            <form action="submit_registration.php" method="POST">
                <label for="event">Choose Event:</label>
                <select name="event" id="event" required>
                    <?php
                    // Loop through the events and populate the dropdown
                    while ($event = $events_result->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='" . $event['id'] . "'>" . $event['name'] . "</option>";
                    }
                    ?>
                </select>

                <label for="name">Your Name:</label>
                <input type="text" id="name" name="name" required>

                <label for="email">Your Email:</label>
                <input type="email" id="email" name="email" required>

                <button type="submit">Register</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Event Management System</p>
    </footer>

</body>
</html>
