<?php

// Connect to the database
//check connect
include "../config.php";


// Function to add a new student to the database
function addStudent($name, $email) {
    global $conn;

    $sql = "INSERT INTO student (name, email) VALUES ('$name', '$email')";

    if (mysqli_query($conn, $sql)) {
        echo "New student added successfully<br>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Function to edit an existing student in the database
function editStudent($id, $name, $email) {
    global $conn;

    $sql = "UPDATE student SET name='$name', email='$email' WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        echo "Student details updated successfully<br>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Function to remove a student from the database
function removeStudent($id) {
    global $conn;

    $sql = "DELETE FROM student WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        echo "Student removed successfully<br>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Handle form submissions
if (isset($_POST['submit'])) {
    $action = $_POST['action'];

    if ($action == 'add') {
        $name = $_POST['name'];
        $email = $_POST['email'];

        addStudent($name, $email);
    } elseif ($action == 'edit') {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];

        editStudent($id, $name, $email);
    } elseif ($action == 'remove') {
        $id = $_POST['id'];

        removeStudent($id);
    }
}

// Display the form
echo '<form method="post">';
echo '<input type="hidden" name="action" value="add">';
echo 'Name: <input type="text" name="name"><br>';
echo 'Email: <input type="text" name="email"><br>';
echo '<button type="submit" name="submit">Add student</button>';
echo '</form>';

// Display the list of students
$sql = "SELECT * FROM student";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo '<table>';
    echo '<tr><th>ID</th><th>Name</th><th>Email</th><th>Action</th></tr>';

    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . $row['name'] . '</td>';
        echo '<td>' . $row['email'] . '</td>';
        echo '<td>';
        echo '<form method="post">';
        echo '<input type="hidden" name="action" value="edit">';
        echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
        echo '<input type="text" name="name" value="' . $row['name'] . '">';
        echo '<input type="text" name="email" value="' . $row['email'] . '">';
        echo '<button type="submit" name="submit">Save</button>';
        echo '</form>';
        echo '<form method="post">';
        echo '<input type="hidden" name="action" value="remove">';
        echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
        echo '<button type="submit" name="submit">Remove</button>';
        echo '</form>';
        echo '</td>';
        echo '</tr>';
    }

    echo '</table>';
} else {
    echo "0 results";
}

// Close the database connection
mysqli_close($conn);
?>