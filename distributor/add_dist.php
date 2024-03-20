<?php
include("../config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $contactPerson = $_POST["contact_person"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];

    $sql = "INSERT INTO distributor (name, contact_person, email, phone)
            VALUES ('$name', '$contactPerson', '$email', '$phone')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Distributor</title>
</head>

<body>
    <h2>Add Distributor</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        Name: <input type="text" name="name" required><br>
        Contact Person: <input type="text" name="contact_person" required><br>
        Email: <input type="email" name="email" required><br>
        Phone: <input type="text" name="phone" required><br>
        <input type="submit" value="Add Distributor">
    </form>
</body>

</html>
