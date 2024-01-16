<?php include 'nav.php'; ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>update</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script type="text/javascript" src="script.js"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="div7">

        <?php
        include 'db.php';

        $show_num = "";
        $show_email = "";

    //   data show in the form into database

        $get_id = $_REQUEST['id'];


        $check = "SELECT * FROM employee_info WHERE id=$get_id";

        $run = mysqli_query($database_connection, $check);


        if ($run == true) {
            while ($data = mysqli_fetch_array($run)) { ?>

                <form method="post" action="" enctype="multipart/form-data">


                <label>Enter Name</label><br>
                    <span style="color: red" id="err_name"> </span><br>
                    <input type="text" placeholder="Enter Your name" name="name" value="<?php echo $data["name"]; ?>" id="v_name"><br><br>

                    <label>Enter Phone Number</label><br>
                    <span style="color: red" id="err_number" <?php echo $show_num; ?>></span> <br>
                    <input type="number" placeholder="Enter Your Phone number" name="number" value="<?php echo $data["number"]; ?>" id="v_number"><br>

                    <label>Enter Your Email</label><br>
                    <span style="color: red" id="err_email" <?php echo $show_email; ?>></span> <br>
                    <input type="email" placeholder="Enter your Email Address" name="email" id="v_email" value="<?php echo $data["email"]; ?>"><br>

                    <label>Enter Address</label><br>
                    <span style="color: red" id="err_address"></span> <br>
                    <input type="text" placeholder="Enter your Address" name="address" id="v_address" value="<?php echo $data["address"]; ?>"><br>

                    <label>Enter Image</label><br>
                    <span style="color: red" id="err_image"></span> <br>
                    <input type="file" name="image" id="v_image" value="<?php echo  $data['image']; ?>"><br>

                    <label>Enter Joining Date</label><br>
                    <span style="color: red" id="err_date"></span> <br>
                    <input type="date" name="date" id="v_date" value="<?php echo $data["date"]; ?>"><br><br>

                   
                    <button type="submit" name="submit" onclick="return validateForm()">Update</button>




                </form>

        <?php }
        } ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>

<?php
include 'db.php';

// data update 

if (isset($_POST['submit'])) {


    $name    = $_POST['name'];
    $number  = $_POST['number'];
    $email   = $_POST['email'];
    $address = $_POST['address'];

    $image = $_FILES['image']['name'];
    $temp_name = $_FILES['image']['tmp_name'];
    $upload_folder = 'image/';
    $uniq_image_name = uniqid();
    move_uploaded_file($temp_name, $upload_folder . "$uniq_image_name.jpg");

    $date    = $_POST['date'];
    $gender  = $_POST['gender'];
    $password = $_POST['password'];
    $incrpassword = md5(sha1($password));

    $check = " SELECT * FROM employee_info  WHERE number = '$number' OR  email = '$email'";

    $result = mysqli_query($database_connection, $check);
    $row = mysqli_num_rows($result);
    if ($row > 0) {
        while ($data = mysqli_fetch_assoc($result)) {
            if ($data['number'] == $number) {
                $show_num = 'Number Already Exists. Try with another one!';
                break;
            } else if ($data['email'] == $email) {
                $show_email = 'Email Already Exists. Try with another one!';
                break;
            }
        }
    }



$update_query = "UPDATE employee_info SET name='$name', number='$number',
email='$email', address='$address', image='$uniq_image_name.jpg', date='$date',
gender='$gender',password='$incrpassword'  WHERE id='$get_id'";

    if (mysqli_query($database_connection,$update_query) == true) {
?>
        <script>
            alert("successfully Update");
            window.location.replace("index.php");
        </script>/
<?php
    } else {
        echo "Something went wrong with the database insert.";
    }
}


?>