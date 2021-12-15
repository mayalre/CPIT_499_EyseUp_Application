<?php

class DB_Functions
{

    private $conn;

    private $img_url;

    // constructor
    function __construct()
    {
        require_once 'DB_Connect.php';
        // connecting to database
        $db = new Db_Connect();
        $this->img_url = 'http://localhost/driver-api/';
        $this->conn = $db->connect();
    }

    // destructor
    function __destruct()
    {

    }

    /**
     * Storing new user
     * returns user details
     */
    public function storeUser(
        $username,
        $password,
        $phone,
        $birthdate,
        $address)
    {

        $password = md5($password);
        $stmt = $this->conn->prepare("INSERT INTO `users` (`id`, `username`, `password`, `phone`, `birthdate`, `status`, `address`) VALUES (NULL, ?,?, ?, ?, 0,?);");
        $stmt->bind_param("sssss", $username,
            $password,
            $phone,
            $birthdate,
            $address);
        $result = $stmt->execute();
        $stmt->close();

        // check for successful store
        if ($result) {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE phone = ?");
            $stmt->bind_param("s", $phone);
            $stmt->execute();
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();

            return $user;
        } else {
            return false;
        }
    }


    public function updateUser($user_id,
                               $username,
                               $birthdate,
                               $status)
    {

        if ($username != -1) {
            $sql = "UPDATE users SET username='" . $username . "' where id=" . $user_id . ";";
            $this->conn->query($sql);
        }

        if ($birthdate != -1) {
            $sql = "UPDATE users SET birthdate='" . $birthdate . "' where id=" . $user_id . ";";
            $this->conn->query($sql);
        }

        if ($status != -1) {
            $sql = "UPDATE users SET status='" . $status . "' where id=" . $user_id . ";";
            $this->conn->query($sql);
        }

        $stmt = $this->conn->prepare("SELECT * FROM users WHERE id =" . $user_id);
        $stmt->execute();
        $user = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $user;
    }

    public function verifyUser($phone)
    {


        $sql = "UPDATE users SET status=1;";
        $this->conn->query($sql);

        $stmt = $this->conn->prepare("SELECT * FROM users WHERE phone =" . $phone);
        $stmt->execute();
        $user = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $user;
    }


    public function updateUserPassword(
        $phone, $password)
    {


        $password = md5($password);
        $sql = "UPDATE users SET password='" . $password . "' where phone='" . $phone . "';";
        $this->conn->query($sql);

        $stmt = $this->conn->prepare("SELECT * FROM users WHERE phone ='" . $phone . "';");
        $stmt->execute();
        $user = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $user;
    }

    /**
     * Get user by email and password
     */
    public function getUserByEmailAndPassword($phone, $password)
    {

        $password = md5($password);

        $stmt = $this->conn->prepare("SELECT * FROM `users` WHERE `phone`='" . $phone . "' and `password`='" . $password . "' and status=1;");

        if ($stmt->execute()) {
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();

            return $user;
        } else {
            return false;
        }
    }

    /**
     * Check user is existed or not
     */
    public function isUserExisted($phone)
    {
        $stmt = $this->conn->prepare("SELECT * from users WHERE phone = ?");

        $stmt->bind_param("s", $phone);

        $stmt->execute();

        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // user existed 
            $stmt->close();
            return true;
        } else {
            // user not existed
            $stmt->close();
            return false;
        }
    }


}

?>
