<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Management System</title>
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>
    <header>
        <div class="auth-buttons">
            <?php if (isset($_SESSION['username'])): ?>
                <!-- Show Logout button if logged in -->
                <span>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</span>
                <a href="logout.php"><button>Logout</button></a>
            <?php else: ?>
                <!-- Show Login button if not logged in -->
                <a href="login.php"><button>Login</button></a>
            <?php endif; ?>
        </div>
        <h1>Welcome to the Event Management System</h1>
        <nav>
            <ul>
                <li><a href="register.php">Register</a></li>
                <li><a href="events.php">View Events</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section>
            <h2>About the System</h2>
            <p>This system allows you to manage events, register attendees, and view registrations.</p>
        </section>
        <section>
            <h2>Features</h2>
            <ul>
                <li>Create and manage events.</li>
                <li>Allow users to register for events.</li>
                <li>Generate reports and attendee lists.</li>
            </ul>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Event Management System</p>
    </footer>
</body>
</html>
