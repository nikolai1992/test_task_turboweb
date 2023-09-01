<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 27.10.2022
 * Time: 01:15
 */
namespace application\lib;

class Db
{
    protected $db;
    protected $result;

    public function __construct()
    {
        $config = require "application/config/db.php";
        $this->db = new \PDO('mysql:host=' . $config['host'] . ";dbname=" . $config['name'], $config['user']
            , $config['password']);
    }

    public function query($sql, $params = [])
    {
        $stmt = $this->db->prepare($sql);
        if (!empty($params)) {
            foreach ($params as $key => $val) {
                $stmt->bindValue(":" . $key, $val);
            }
        }
        $stmt->execute();

        return $stmt;
    }

    public function row($sql, $params = [])
    {
        $result = $this->query($sql, $params);
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function column($sql, $params = [])
    {
        $result = $this->query($sql);
        return $result->fetchColumn();
    }

    public function get()
    {
        $this->result->execute();
        return $this->result->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function auth($request)
    {
        $email = $request["email"];
        if ($stmt = $this->db->prepare('SELECT id, password, first_name FROM users WHERE email = "'.$email.'"')) {
            // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
            $stmt->execute(array($email));
            $row  = $stmt->fetch();
            if (password_verify($_POST['password'], $row["password"])) {
                // Verification success! User has logged-in!
                // Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
                session_regenerate_id();
                $_SESSION['loggedin'] = TRUE;
                $_SESSION['name'] = $_POST['email'];
                $_SESSION['id'] = $row["id"];
                $_SESSION['first_name'] = $row["first_name"];
                echo 'Welcome ' . $_SESSION["first_name"] . '!';
            } else {
                // Incorrect password
                echo 'Incorrect username and/or password!';
            }
            die;
            $stmt->bindParam('s', $_POST['username']);
            $stmt->execute();
            // Store the result so we can check if the account exists in the database.
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                $stmt->bind_result($id, $password);
                $stmt->fetch();
                // Account exists, now we verify the password.
                // Note: remember to use password_hash in your registration file to store the hashed passwords.
                if (password_verify($_POST['password'], $password)) {
                    // Verification success! User has logged-in!
                    // Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
                    session_regenerate_id();
                    $_SESSION['loggedin'] = TRUE;
                    $_SESSION['name'] = $_POST['email'];
                    $_SESSION['id'] = $id;
                    debug("logged in");
                    echo 'Welcome ' . $_SESSION['name'] . '!';
                } else {
                    // Incorrect password
                    echo 'Incorrect username and/or password!';
                }
            } else {
                // Incorrect username
                echo 'Incorrect username and/or password!';
            }

            $stmt->close();
        }
    }
}