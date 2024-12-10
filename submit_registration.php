<?php
// Include the database connection
include('db.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and sanitize the input data
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $event_id = (int) $_POST['event']; // Ensure it's an integer

    // Validate input
    if (empty($name) || empty($email) || empty($event_id)) {
        echo "Please fill in all fields.";
        exit;
    }

    // Insert attendee into the attendees table (if you have such a table)
    // If the attendees table does not exist, this step can be skipped
    try {
        // Insert attendee into the users or attendees table to get their ID
        $stmt = $conn->prepare("INSERT INTO attendees (name, email) VALUES (:name, :email)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        // Get the last inserted attendee ID (to associate with the registration)
        $attendee_id = $conn->lastInsertId();

        // Prepare and execute the registration insert
        $stmt = $conn->prepare("INSERT INTO registrations (event_id, attendee_id, registration_date) VALUES (:event_id, :attendee_id, NOW())");
        $stmt->bindParam(':event_id', $event_id);
        $stmt->bindParam(':attendee_id', $attendee_id);

        // Execute the query
        $stmt->execute();

        // Check if the registration was successful
        if ($stmt->rowCount() > 0) {
            echo "Registration successful!";
            // Optionally, redirect to a success page
            // header("Location: success_page.php");
        } else {
            echo "Something went wrong. Please try again later.";
        }
    } catch (PDOException $e) {
        // Handle errors (e.g., database issues)
        echo "Error: " . $e->getMessage();
    }
}
?>
