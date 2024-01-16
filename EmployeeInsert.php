<?php
include 'db.php';

$errors = [];

if (isset($_POST['submit'])) {

    $dynamicData = array(
        'name' => $_POST['name'],
        'number' => $_POST['number'],
        'email' => $_POST['email'],
        'address' => $_POST['address'],
        'date' => $_POST['date'],
        // 'gender' => $_POST['gender']
    );

    // Handle image uploads
    $uploadedImages = array();
    $imageFolder = 'image/';

    foreach ($_FILES['image']['tmp_name'] as $key => $tmpName) {
        $imageName = $_FILES['image']['name'][$key];
        $imagePath = $imageFolder . $imageName;
        move_uploaded_file($tmpName, $imagePath);
        $uploadedImages[] = $imageName;
    }

    foreach ($dynamicData['name'] as $key => $value) {

        // Validate each set of form fields
        $name = $dynamicData['name'][$key];
        $number = $dynamicData['number'][$key];
        $email = $dynamicData['email'][$key];
        $address = $dynamicData['address'][$key];
        $date = $dynamicData['date'][$key];
        // $gender = $dynamicData['gender'][$key];

        // Perform validation for each field
        if (empty($name) || !preg_match("/^[a-zA-Z ]*$/", $name)) {
            $errors['name'][$key] = "Please enter a valid name";
        }

        if (empty($number) || !preg_match("/^[0-9]{11}$/", $number)) {
            $errors['number'][$key] = "Please enter a valid phone number";
        }

        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'][$key] = "Please enter a valid email address";
        }

        if (empty($address)) {
            $errors['address'][$key] = "Please enter your address";
        }

        // You might want to perform more complex validation for file uploads
        if (empty($uploadedImages[$key])) {
            $errors['image'][$key] = "Please select an image";
        }

        if (empty($date)) {
            $errors['date'][$key] = "Please enter the joining date";
        }

        // if (empty($gender)) {
        //     $errors['gender'][$key] = "Please select your gender";
        // }
    }

    // Check if there are any validation errors
    if (empty($errors)) {
        // Insert data into the database
        foreach ($dynamicData['name'] as $key => $value) {
            $dynamicForm = "INSERT INTO employee_info (name, number, email, address, image, date, gender) 
                            VALUES ('{$dynamicData['name'][$key]}', '{$dynamicData['number'][$key]}', '{$dynamicData['email'][$key]}',
                                    '{$dynamicData['address'][$key]}', '{$uploadedImages[$key]}', '{$dynamicData['date'][$key]}')";

            if (mysqli_query($database_connection, $dynamicForm)) {
                ?>
                <script>
                    alert("Successfully inserted data");
                    window.location.replace("index.php");
                </script>
                <?php
            } else {
                echo "Something went wrong with the database insert.";
            }
        }
    }
}

?>

