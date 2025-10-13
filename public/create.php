

<?php
if (isset($_POST["submit"])) {
    require "../common.php";

    try {

        require_once '../src/DBconnect.php';
        $new_user = array(
                "firstName" => escape($_POST["firstname"]),
                "lastName" => escape($_POST["lastname"]),
                "email" => escape($_POST["email"]),
                "age" => escape($_POST["age"]),
                "location" => escape($_POST["location"]),
        );

        $sql = sprintf("INSERT INTO %s (%s) values (%s)", "users",
                implode(", ", array_keys($new_user)),
                ":" . implode(", :", array_keys($new_user)));

        $statement = $connection->prepare($sql);
        $statement->execute($new_user);

    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }



}

require "templates/header.php";
if (isset($_POST["submit"]) && $statement) {
    echo $new_user['firstName'] . ' successfully added';
}

?>


<h2>Add a user</h2>

    <form method="POST" class="col-md-4">
        <div class="col-md-4"> <label for="firstname">First Name</label>
            <input type="text" name="firstname" id="firstname" required></div>
        <div class="col-md-4"><label for="lastname">Last Name</label>
            <input type="text" name="lastname" id="lastname" required></div>
        <div class="col-md-4"><label for="email">Email Address</label>
            <input type="email" name="email" id="email" required></div>
        <div class="col-md-4"><label for="age">Age</label>
            <input type="text" name="age" id="age"></div>
        <div class="col-md-4"><label for="location">Location</label>
            <input type="text" name="location" id="location"></div>
        <input type="submit" name="submit" value="Submit" class="btn btn-primary my-3">
    </form>

<a href="index.php">Back to home</a>

<?php include "templates/footer.php"; ?>
