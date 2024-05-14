<?php
    session_start();

    include '../classes/User.php';

    $user_obj = new User;
    $all_users = $user_obj->getAllUsers();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap CDN-->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!--fontawesome CDN-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!--CSS-->
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <nav class="navbar navbar-expand navbar-dark bg-dark mb-5">
        <div class="container">
            <a href="dashboard.php" class="navbar-brand">
                <h3>The Company</h3>
            </a>
            <div class="navbar-nav">
                <span class="navbar-text"><?=$_SESSION['full_name'] ?></span>
                <form action="../actions/logout.php" method="post" class="d-flex ms-2">
                    <button type="submit" class="text-danger bg-transparent border-0">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <main class="row justify-content-center gx-0">
        <div class="col-6">
            <h2 class="text-center">USER LIST</h2>

            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th><!--for photo--></th>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Username</th>
                        <th><!--for actions sbutton--></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while($user = $all_users->fetch_assoc()) {
                          # print_r($user); 
                        
                    ?>
                    <tr>
                        <td>
                            <!--Display the photo of the user -->
                            <?php 
                                if($user['photo']){
                            ?>
                                <img src="../assets/images/<?=$user['photo'] ?>" alt="<?=$user['photo'] ?>" class="d-block mx-auto dashboard-photo">
                            <?php
                                }else {
                            ?>
                                <i class="fa-solid fa-user text-secondary d-block text-center dashboard-icon"></i>
                            <?php
                                }
                            ?>
                        </td>
                        <td><?= $user['id']?></td>
                        <td><?= $user['first_name']?></td>
                        <td><?= $user['last_name']?></td>
                        <td><?= $user['username']?></td>
                        <td>
                            <!--If the user owns the account,edit and delete button must be shown-->
                            <?php
                                if($_SESSION['id'] == $user['id']) {
                            ?>
                           <!-- # if the session is equal to the velue we get from the result display the button -->
                           <a href="edit-user.php" class="btn btn-outline-warning"title="Edit">
                            <i class="fa-regular fa-pen-to-square"></i>
                           </a>

                           <a href="delete-user.php" class="btn btn-outline-danger"title="Delete">
                            <i class="fa-regular fa-trash-can"></i>
                           </a>
                            <?php
                                }
                            ?>
                        </td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>
