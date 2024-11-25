<?php
// Include database connection
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $vehicleID = $_GET['id'];

    // Fetch vehicle details
    $sql = "SELECT * FROM Vehicles WHERE VehicleID = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $vehicleID]);
    $vehicle = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$vehicle) {
        die("Vehicle not found.");
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission
    $vehicleID = $_POST['VehicleID'];
    $manufacturer = $_POST['Manufacturer'];
    $model = $_POST['Model'];
    $year = $_POST['Year'];
    $price = $_POST['Price'];
    $specifications = $_POST['Specifications'];

    // Update vehicle in the database
    $sql = "UPDATE Vehicles SET Manufacturer = :manufacturer, Model = :model, Year = :year, Price = :price, Specifications = :specifications WHERE VehicleID = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':manufacturer' => $manufacturer,
        ':model' => $model,
        ':year' => $year,
        ':price' => $price,
        ':specifications' => $specifications,
        ':id' => $vehicleID
    ]);

    header("Location: read.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Vehicle</title>
</head>
<body>
    <h1>Update Vehicle</h1>
    <form action="update_vehicle.php" method="POST">
        <input type="hidden" name="VehicleID" value="<?= htmlspecialchars($vehicle['VehicleID']) ?>">
        <label for="Manufacturer">Manufacturer:</label>
        <input type="text" name="Manufacturer" id="Manufacturer" value="<?= htmlspecialchars($vehicle['Manufacturer']) ?>" required><br>
        <label for="Model">Model:</label>
        <input type="text" name="Model" id="Model" value="<?= htmlspecialchars($vehicle['Model']) ?>" required><br>
        <label for="Year">Year:</label>
        <input type="number" name="Year" id="Year" value="<?= htmlspecialchars($vehicle['Year']) ?>" required><br>
        <label for="Price">Price:</label>
        <input type="number" name="Price" id="Price" value="<?= htmlspecialchars($vehicle['Price']) ?>" required><br>
        <label for="Specifications">Specifications:</label>
        <textarea name="Specifications" id="Specifications" required><?= htmlspecialchars($vehicle['Specifications']) ?></textarea><br>
        <button type="submit">Update Vehicle</button>
    </form>
    <a href="view_vehicles.php">Back to Vehicle List</a>
</body>
</html>
