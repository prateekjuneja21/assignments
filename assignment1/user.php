<?php
include_once 'db_conn.php';

if (isset($_POST['btn-create-account'])) {
    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $sql = "SELECT email FROM user WHERE email='$user_email'";
    $resultset = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($resultset);
    $current_time = time();
    $modification_time = time();
    if (!$row['email']) {
        $sql = "Insert INTO user(
                name,
                email,
                password,
                is_active,
                is_deleted,
                user_type,
                creation_date,
                modification_date
                )
        VALUES (
            '$user_name',
            '$user_email',
            '$user_password',
             1,
             0,
            'student',
            $current_time,
            $modification_time
            )";

        mysqli_query($con, $sql);
        $last_inserted_id = mysqli_insert_id($con);
        echo $last_inserted_id;exit();

    } else {
        echo "1";
    }

} elseif (isset($_POST['login-button'])) {
    $user_email = trim($_POST['user-email']);
    // echo $user_email;
    $user_password = trim($_POST['password']);
    $sql = "SELECT email FROM user WHERE email='$user_email'";
    $resultset = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($resultset);
    echo "<pre>";
    print_r($row);
    echo "</pre>";
    if (count($row) > 0) {
        echo "user already exist";

    } else {

    }
    if ($row['pass'] == $user_password) {
        echo "ok";
    }
}
