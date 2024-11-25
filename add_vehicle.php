<?php
session_start();
require 'db.php';

// // Check if user is admin
// if ($_SESSION['Role_name'] !== 'Admin') {
//     die('You do not have permission to add a vehicle.');
// }

// Process the form submission for adding a vehicle
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $manufacturer = $_POST['manufacturer'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $price = $_POST['price'];

    $stmt = $pdo->prepare("INSERT INTO Vehicles (Manufacturer, Model, Year, Price) VALUES (:manufacturer, :model, :year, :price)");
    $stmt->execute(['manufacturer' => $manufacturer, 'model' => $model, 'year' => $year, 'price' => $price]);

    echo '<div class="success-message">Vehicle added successfully!</div>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Vehicle</title>
    <!-- CSS Styling -->
    <style>
        

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            
        }

        .navbar {
            background-color: #333;
            padding: 15px;
            text-align: center;
        }

        .navbar ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .navbar ul li {
            display: inline;
            margin: 0 20px;
        }

        .navbar ul li a {
            color: white;
            text-decoration: none;
            font-size: 18px;
        }

        .navbar ul li a:hover {
            color: #f39c12;
        }

        header h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .vehicle-form {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }

        .vehicle-form label {
            font-size: 16px;
            margin-bottom: 8px;
            display: block;
            font-weight: bold;
        }

        .vehicle-form input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .vehicle-form button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        .vehicle-form button:hover {
            background-color: #45a049;
        }

        .back-link {
            text-align: center;
            margin-top: 20px;
        }

        .back-link a {
            color: #007bff;
            text-decoration: none;
        }

        .back-link a:hover {
            text-decoration: underline;
        }

        footer {
            text-align: center;
            margin-top: 40px;
            font-size: 14px;
            color: #888;
        }

        .success-message {
            color: #28a745;
            text-align: center;
            font-size: 16px;
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <!-- Navigation Bar -->
    <nav class="navbar">
        <ul>
            <li><a href="admin.php">Dashboard</a></li>
            <li><a href="add_vehicle.php">Add Vehicle</a></li>
            <li><a href="read.php">View Vehicles</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <header>
        <h1>Add Vehicle</h1>
    </header>

    <main>
        <form method="POST" class="vehicle-form">
            <label for="manufacturer">Manufacturer:</label>
            <input type="text" name="manufacturer" id="manufacturer" required>
            
            <label for="model">Model:</label>
            <input type="text" name="model" id="model" required>
            
            <label for="year">Year:</label>
            <input type="number" name="year" id="year" required>
            
            <label for="price">Price:</label>
            <input type="number" name="price" id="price" required>
            
            <button type="submit" class="submit-btn">Add Vehicle</button>
        </form>

        <div class="back-link">
            <a href="admin.php">Back to Dashboard</a>
        </div>
    </main>

    <footer>
        &copy; 2024 Winnipeg Wheels
    </footer>

    
</body>
</html>
