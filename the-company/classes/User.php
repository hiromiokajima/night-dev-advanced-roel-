<!--Child Class-->

<?php
    include "Database.php";

    class User extends Database {
        # The logic of the application will be placed here(CRUD,data manipulation,arethmetic operations)

        #The store() method inserts a record into the users table
        public function store($request){
            # $request holds the data from the form.This will catch the value of $_POST from actions/register.php

            $first_name = $request['first_name'];
            $last_name = $request['last_name'];
            $username = $request['username'];
            $password = $request['password'];

            # Encrypt the password

            $password = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO users (first_name,last_name,username, `password`) VALUES ('$first_name','$last_name','$username','$password')";

            if($this->conn->query($sql)){
                header('location: ../views'); //go to index.php
                exit;// some as die

            }else {
                die('Error in creating the user account: ' .$this->conn->error);

            }
        }

        public function login($request) {
            $username = $request['username'];
            $password = $request['password'];

            $sql = "SELECT * FROM users WHERE username = '$username'";
            $result =$this->conn->query($sql);

            # Check if the username is existing or not
            if($result->num_rows == 1) {
                # if the username is existing it will return 1, otherwise return 0if not found.

                $user = $result->fetch_assoc();
                # user = ['id' =>, 'username' => 'mary','password' =>'$2y$1qu'];

                #Check if the password is correct
                if(password_verify($password,$user['password'])){
                    # Create session variables for future use.
                    session_start();
                    $_SESSION['id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['full_name'] = $user['first_name'] . " " . $user['last_name'];

                    header('location: ../views/dashboard.php');
                    exit;
                } else {
                    die('Password is incorrect.');
                }
            } else {
                die('Username not found.');
            }
        }

        public function logout() {
            session_start();
            session_unset();
            session_destroy();

            header('location: ../views');//redirected to the login page (index.php)
            exit;
        }

        public function getAllUsers() {
            $sql = "SELECT * FROM users";

            if($result = $this->conn->query($sql)){
                return $result;
            }else{
                die('Error in retrieving the information of all users: ' . $this->conn->error);
            }
        }
    

    public function getUser($id) {
        $sql = "SELECT * FROM users WHERE id = $id";
        #Retrive specific user

        if($result = $this->conn->query($sql)) {
            return $result->fetch_assoc();
        } else {
            die('Error in retrieving the user account: '. $this->conn->error);
        }
    }

    public function update($request,$files){
        session_start();
        $id = $_SESSION['id']; #Get the id of the person who is currently logged in
        $first_name = $request['first_name'];
        $last_name = $request['last_name'];
        $username = $request['username'];

        $photo = $files['photo']['name']; #Get the name of the file
        $tmp_photo = $files['photo']['tmp_name'];# Indicate the path of the file inside the temporary strage in your computer. The file is place in a temporary folder befor moving it to the destination

        $sql = "UPDATE users SET first_name ='$first_name',last_name  ='$last_name',username = '$username' WHERE id = $id";

        if($this->conn->query($sql)){
            #Set the value of the new Sessions
            $_SESSION['username']= $username;
            $_SESSION['full_name']= "$first_name $last_name";

            # If there is an update photo,save it to the db and save the file to the images folder
            #image file -> images folder
            #image name -> db
            if($photo) {
                $sql = "UPDATE users SET photo = '$photo' WHERE id = $id";
                $destination = "../assets/images/$photo";

                if($this->conn->query($sql)){
                    # save the images in designated folder
                    if(move_uploaded_file($tmp_photo,$destination)){
                        header('location: ../views/dashboard.php');
                        exit;
                    }else{
                        die('Error moving the photo.');
                    }

                }else {
                    die('Error uploading photo: ' .$this->conn->error);

                }
            }

            # Redirect
            header('location: ../views/dashboard.php');
            exit;

        }else {
            die('Error in updating the user information: ' .$this->conn->error);
        }


    }
    public function delete() {
        # delete( allows us to delete the record of the user permanently)
        session_start();
        $id = $_SESSION['id'];#Get the ID of the user who is currently logged in

        $sql = "DELETE FROM users WHERE id = $id";
        if($this->conn->query($sql)) {
            $this->logout();
           
        } else {
            die('Error in deleting the account: ' . $this->conn->error);
        }
    }

    }

?>