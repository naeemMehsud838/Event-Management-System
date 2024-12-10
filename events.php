<?php
include 'db.php'; // Include database connection

// Handle form submission to add an event
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $date = $_POST['date'];
    $location = $_POST['location'];
    $capacity = $_POST['capacity'];
    $description = $_POST['description'];

    $sql = "INSERT INTO Events (name, date, location, capacity, description) VALUES (:name, :date, :location, :capacity, :description)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':name' => $name,
        ':date' => $date,
        ':location' => $location,
        ':capacity' => $capacity,
        ':description' => $description
    ]);

    echo "Event added successfully!";
}

// Fetch all events
$sql = "SELECT * FROM Events";
$stmt = $conn->prepare($sql);
$stmt->execute();
$events = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Events</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    
    <h1>Event Management</h1>

    <h2>Add Event</h2>
    <form method="POST" action="events.php">
        <label>Name:</label>
        <input type="text" name="name" required><br>
        <label>Date:</label>
        <input type="date" name="date" required><br>
        <label>Location:</label>
        <input type="text" name="location" required><br>
        <label>Capacity:</label>
        <input type="number" name="capacity" required><br>
        <label>Description:</label>
        <textarea name="description"></textarea><br>
        <button type="submit">Add Event</button>
    </form>

    <h2>All Events</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Date</th>
            <th>Location</th>
            <th>Capacity</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($events as $event): ?>
        <tr>
            <td><?= $event['id'] ?></td>
            <td><?= $event['name'] ?></td>
            <td><?= $event['date'] ?></td>
            <td><?= $event['location'] ?></td>
            <td><?= $event['capacity'] ?></td>
            <td>
                <a href="delete_event.php?id=<?= $event['id'] ?>">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
