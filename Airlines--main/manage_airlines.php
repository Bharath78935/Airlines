<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add'])) {
        $airline_name = $_POST['airline_name'];
        $sql = "INSERT INTO Airlines (airline_name) VALUES ('$airline_name')";
        $conn->query($sql);
    } elseif (isset($_POST['update'])) {
        $airline_id = $_POST['airline_id'];
        $airline_name = $_POST['airline_name'];
        if (!empty($airline_id)) { // Ensure airline_id is set
            $sql = "UPDATE Airlines SET airline_name='$airline_name' WHERE airline_id=$airline_id";
            $conn->query($sql);
        }
    } elseif (isset($_POST['delete'])) {
        $airline_id = $_POST['airline_id'];
        $sql = "DELETE FROM Airlines WHERE airline_id=$airline_id";
        $conn->query($sql);
        $conn->query("ALTER TABLE Airlines AUTO_INCREMENT = 1");
    }
}

$result = $conn->query("SELECT * FROM Airlines");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Airlines</title>
    <link rel="stylesheet" href="style2.css">

</head>
<body>
    <div>
        <a href="index.php">
            <img class="home" src="images/home.jpg" alt="home">
        </a>
    </div>
    <h2>Manage Airlines</h2>
    <form method="POST" action="manage_airlines.php">
        <fieldset>
            <legend>Airline Information</legend>
            <input type="hidden" name="airline_id" id="airline_id">
            <label for="airline_name">Airline Name:</label>
            <input type="text" name="airline_name" id="airline_name" required>
            <div style="display: flex; justify-content: space-between;">
                <button type="submit" name="add">Add Airline</button>
                <button type="submit" name="update">Update Airline</button>
            </div>
        </fieldset>
    </form>

    <h3>Current Airlines</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Airline Name</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['airline_id'] ?></td>
            <td><?= $row['airline_name'] ?></td>
            <td>
                <button type="button" class="edit" onclick="editAirline('<?= $row['airline_id'] ?>', '<?= $row['airline_name'] ?>')">Edit</button>
                <form class="del" method="POST" action="manage_airlines.php" style="display:inline;">
                    <input type="hidden" name="airline_id" value="<?= $row['airline_id'] ?>">
                    <button class="delete" type="submit" name="delete">Delete</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <script>
        function editAirline(id, name) {
            document.getElementById("airline_id").value = id;
            document.getElementById("airline_name").value = name;
        }
    </script>
</body>
</html>
