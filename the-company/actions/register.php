<?php
    include "../classes/User.php";  

    # Create an Object
    $user = new User;

    # Call the method inside the class

    $user->store($_POST);
    # $_POST holds all data from the form in views/register.php
    # $_POST['name of the input field']
    # $_POST['first_name'];
?>