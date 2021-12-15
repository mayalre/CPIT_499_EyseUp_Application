<?php

header("Content-Type: application/json");

error_reporting(E_ALL);
ini_set('display_errors', 'On');

// json response array
$response = array("error" => FALSE);
$img_url = 'http://localhost/driver-api/';

require_once 'DB_Functions.php';
$db = new DB_Functions();

if (isset($_GET['type']) || isset($_POST['type'])) {

    $type = isset($_GET['type']) ? $_GET['type'] : $_POST['type'];

    if ($type == 'login') {
        $phone = $_GET['phone'];
        $password = $_GET['password'];


        if (strlen($phone) < 10) {
            $response["error"] = TRUE;
            $response["msg"] = $phone . " is not a valid phone";
            echo json_encode($response);
            die();
        }


        if (strlen($password) < 8) {
            $response["error"] = TRUE;
            $response["msg"] = "Password should be more than 8 letters";
            echo json_encode($response);
            die();
        }

        $user = $db->getUserByEmailAndPassword($phone, $password);

        if ($user != false) {
            $response["error"] = FALSE;
            $response["msg"] = "Login successfully";
            $response["data"]["id"] = $user["id"];
            $response["data"]["username"] = $user["username"];
            $response["data"]["phone"] = $user["phone"];
            $response["data"]["birthdate"] = $user["birthdate"];
            $response["data"]["address"] = $user["address"];

            echo json_encode($response);
            die();
        } else {
            $response["error"] = TRUE;
            $response["msg"] = "Login credentials are wrong. Please try again!";
            echo json_encode($response);
            die();
        }

    }

    if ($type == 'register') {
        $username = $_GET['username'];
        $password = $_GET['password'];
        $phone = $_GET['phone'];
        $birthdate = $_GET['birthdate'];
        $address = isset($_GET['address']) ? $_GET['address'] : '';

        if (strlen($username) < 2) {
            $response["error"] = TRUE;
            $response["msg"] = "Enter valid name";
            echo json_encode($response);
            die();
        }

        if (strlen($phone) < 8) {
            $response["error"] = TRUE;
            $response["msg"] = $phone . " is not a valid phone";
            echo json_encode($response);
            die();
        } else {

            if ($db->isUserExisted($phone)) {
                $response["error"] = TRUE;
                $response["msg"] = "Phone used before!";
                echo json_encode($response);
                die();
            }
        }

        if (strlen($password) < 8) {
            $response["error"] = TRUE;
            $response["msg"] = "Password should be more than 8 letters";
            echo json_encode($response);
            die();
        }


        $user = $db->storeUser(
            $username,
            $password,
            $phone,
            $birthdate,
            $address);

        if ($user != false) {
            $response["error"] = FALSE;
            $response["msg"] = "Login successfully";
            $response["data"]["id"] = $user["id"];
            $response["data"]["username"] = $user["username"];
            $response["data"]["phone"] = $user["phone"];
            $response["data"]["birthdate"] = $user["birthdate"];
            $response["data"]["address"] = $user["address"];

            echo json_encode($response);
            die();
        } else {
            $response["error"] = TRUE;
            $response["msg"] = "Login credentials are wrong. Please try again!";
            echo json_encode($response);
            die();
        }

    }

    if ($type == 'update-user') {
        $user_id = $_GET['user_id'];
        $username = isset($_GET['username']) ? $_GET['username'] : -1;
        $birthdate = isset($_GET['birthdate']) ? $_GET['birthdate'] : -1;

        $user = $db->updateUser(
            $user_id,
            $username,
            $birthdate,
            -1
        );

        if ($user != false) {
            $response["error"] = FALSE;
            $response["msg"] = "Updated successfully";
            $response["data"]["id"] = $user["id"];
            $response["data"]["username"] = $user["username"];
            $response["data"]["phone"] = $user["phone"];
            $response["data"]["birthdate"] = $user["birthdate"];
            $response["data"]["address"] = $user["address"];

            echo json_encode($response);
            die();
        } else {
            $response["error"] = TRUE;
            $response["msg"] = "Date is wrong. Please try again!";
            echo json_encode($response);
            die();
        }

    }

    if ($type == 'verify-user') {
        $phone = $_GET['phone'];
        $code = $_GET['code'];

        if ($code != '000000') {
            $response["error"] = TRUE;
            $response["msg"] = "Code id not correct!";
            echo json_encode($response);
            die();
        }


        $user = $db->verifyUser(
            $phone
        );

        if ($user != false) {
            $response["error"] = FALSE;
            $response["msg"] = "User verified successfully";
            $response["data"] = [];

            echo json_encode($response);
            die();
        } else {
            $response["error"] = TRUE;
            $response["msg"] = "Date is wrong. Please try again!";
            echo json_encode($response);
            die();
        }

    }


    if ($type == 'reset_password') {
        $phone = $_GET['phone'];
        $new_password = $_GET['new_password'];


        $user = $db->updateUserPassword(
            $phone,
            $new_password
        );

        if ($user != false) {
            $response["error"] = FALSE;
            $response["msg"] = "Updated successfully";
            $response["data"]["id"] = $user["id"];
            $response["data"]["username"] = $user["username"];
            $response["data"]["phone"] = $user["phone"];
            $response["data"]["birthdate"] = $user["birthdate"];
            $response["data"]["address"] = $user["address"];

            echo json_encode($response);
            die();
        } else {
            $response["error"] = TRUE;
            $response["msg"] = "Date is wrong. Please try again!";
            echo json_encode($response);
            die();
        }

    }


} else {
    // required post params is missing
    $response["error"] = TRUE;
    $response["error_msg"] = "Unknown request";
    echo json_encode($response);
    die();
}
?>

