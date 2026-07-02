<?php 

include 'includes/connect.php';
session_start();

function clean($str) {
    global $conn;
    $str = @trim($str);
    return mysqli_real_escape_string($conn, $str);
}

// Sanitize the POST values
$login    = clean($_POST['username']);
$password = clean($_POST['password']);

// Input Validations
if($login == '') {
    $errmsg_arr[] = 'Username missing';
    $errflag = true;
}
if($password == '') {
    $errmsg_arr[] = 'Password missing';
    $errflag = true; 
}

// Create query
$qry  = "SELECT * FROM admin WHERE username=?";
$stmt = mysqli_prepare($conn, $qry);
mysqli_stmt_bind_param($stmt, "s", $login);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Check whether the query was successful or not
if($result) {
    if(mysqli_num_rows($result) > 0) {
        $member = mysqli_fetch_assoc($result);

        // Verify password
        if($member['password'] !== $password) {
            echo '<script>alert("Something went wrong, Enter correct details");window.location.href="sign-in.php";</script>';
            exit;
        }

        // Login successful
        session_regenerate_id();
        $_SESSION['SESS_MEMBER_ID']     = $member['id'];
        $_SESSION['SESS_FIRST_NAME']    = $member['name'];
        $_SESSION['SESS_EMAIL']         = $member['email'];
        $_SESSION['SESS_PHONE_NUMBER']  = $member['phone'];
        $_SESSION['SESS_STATE']         = $member['state'];
        $_SESSION['SESS_ACCESS_LEVEL']  = 3;
        $_SESSION['SESS_ADDRESS']       = $member['address'];         
        $_SESSION['SESS_PRO_PIC']       = $member['photo'];
        $_SESSION['SESS_USERNAME']      = $member['username'];
        $_SESSION['SESS_USERS_ID']      = $member['user_id'];
        session_write_close();
        header("location: index.php");
        exit();

    } else {
        echo '<script>alert("Something went wrong, Enter correct details");window.location.href="sign-in.php";</script>';
        exit;
    }
} else {
    die("Query failed");
}
?>