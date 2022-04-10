<?php

namespace App\Manager;
use App\Entity\User;

use Exception;

class UserManager extends BaseManager
{


    public function getAllUsers(): void
    {
        $stmt = $this->db->prepare('SELECT * FROM user');
        $stmt->execute();
        
        if($stmt->rowCount() > 0)
        {
            $posts_array = [];
            $posts_array["users"] = [];

            while($row = $stmt->fetch(\PDO::FETCH_ASSOC))
            {
                extract($row);

                $data = [
                    "id" => $id,
                    "username" => $username,
                    "password" => $pass,
                    "token" => $token

                ];

                $posts_array["users"][] = $data;
            }

            http_response_code(200);
            print_r(json_encode($posts_array));

        }


    }



    /**
     * @param User $user
     * @return bool
     */
    public function createUser(User $user): bool
    {

        try {
            $stmt = "INSERT INTO user (username, password, token) VALUES (:username, :password, :token)";
            $create = $this->db->prepare($stmt);
            $create->execute(array(
                ':username' => $user->getUsername(),
                ':password' => $user->getPassword(),
                ':token' => $user->getToken()
            ));

            return true;

        } catch (Exception $e) {
            die($e->getMessage());
        }

    }


    /**
     * @param int $id
     * @return bool
     */
    public function deleteUser(int $id)
    {
        try {
            $stmt2 = "DELETE FROM comments WHERE user_id = :id";
            $delete2 = $this->db->prepare($stmt2);
            $delete2->execute(array(
                ':id' => $id
            ));

            $stmt3 = "DELETE FROM post WHERE user_id = :id";
            $delete3 = $this->db->prepare($stmt3);
            $delete3->execute(array(
                ':id' => $id
            ));

            //$BDD = $this->db->getMysqlConnection();
            $stmt = "DELETE FROM user WHERE user_id = :id";
            $delete = $this->db->prepare($stmt);
            $delete->execute(array(
                ':id' => $id
            ));

            return true;

        } catch (Exception $e) {
            return false;
            die($e->getMessage());

        }
    }

    public function validateSignUp(): bool
    {
        $firstName = htmlentities(filter_input(INPUT_POST, "firstName"));
        $lastName = htmlentities(filter_input(INPUT_POST, "lastName"));
        $email = htmlentities(filter_input(INPUT_POST, "email"));
        $pass = htmlentities(filter_input(INPUT_POST, "password"));
        $passConf = htmlentities(filter_input(INPUT_POST, "pass_confirm"));

        if ($pass == $passConf):
            $encrypt = hash('sha256',$pass);
            $newUser = new User($firstName, $lastName, $email, $encrypt);
            $this->createUser($newUser);
            return true;
        else:
            return false;

        endif;
    }



    public function login(): void
    {
        $encrypt = hash('sha256',$_POST['password']);
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['password'] = $encrypt;

    }

  
    public function updatePassword($pass, $id): bool
    {

        $stmt = "UPDATE user SET password =:password WHERE user_id=:id";
        $query = $this->db->prepare($stmt);
        $query->execute(
            array(
                "id" => $id,
                "password" =>  hash("sha256",$pass)
            )
        );
        return true;
    }



   
  
    public function Delete()
    {

        $this->deleteUser($_GET["id"]);

        
    }



}