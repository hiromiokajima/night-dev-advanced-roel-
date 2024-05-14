<?php 
    session_start();

    include "../classes/User.php";

    #Create object
    $user_obj = new User;

    #Call the metod
    $user = $user_obj->getUser($_SESSION['id']);
   # print_r($user);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>

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
    <main class="row justify-content-center gx-0 mb-5">
        <div class="col-4">
            <h2 class="text-center mb-4">EDIT USER</h2>

            <form action="../actions/edit-user.php" method="post"enctype="multipart/form-data">
                <div class="row justify-content-center mb-3">
                    <div class="col-6">
                       <!-- Didplay user photo -->
                       <?php 
                                if($user['photo']){
                            ?>
                                <img src="../assets/images/<?=$user['photo'] ?>" alt="<?=$user['photo'] ?>" class="d-block mx-auto edit-photo">
                            <?php
                                }else {
                            ?>
                                <i class="fa-solid fa-user text-secondary d-block text-center edit-icon"></i>
                            <?php
                                }
                            ?>

                            <input type="file" name="photo" id="photo" class="form-control mt-2" accept="image/*">
                    </div>
                </div>

                <div class="mb-3">
                        <label for="first-name" class="form-label">First Name</label>
                        <input type="text" name="first_name" id ="first-name"class="form-control" value="<?=$user['first_name']?>" required autofocus>
                    </div>

                    <div class="mb-3">
                        <label for="last-name" class="form-label">Last Name</label>
                        <input type="text" name="last_name" id ="last-name"class="form-control"value="<?=$user['last_name']?>" required>
                    </div>

                    <div class="mb-4">
                        <label for="username" class="form-label fw-bold">Username</label>
                        <input type="text" name="username" id="username"class="form-control fw-bold" maxlength="15"value="<?=$user['username']?>" required>
                    </div>

                    <div class="text-end">
                        <a href="dashboard.php" class="btn btn-secondary btn-sm">Cancel</a>
                        <button type="submit" class="btn btn-warning btn-sm px-5">Save</button>
                    </div>
            </form>
        </div>
    </main>
</body>
</html>