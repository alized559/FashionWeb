<?php 

    include './includes/config.php';

    $file = "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fashion | Users</title>

    <link href="css/manageAllUsers.css" rel="stylesheet" media="screen">

    <?php include 'header.php' ?>
</head>
<body>
    <div class="container-fluid">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">User</th>
                    <th scope="col">Profile Photo</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                
                    $sql = "SELECT * FROM users";
                    $result = mysqli_query($db, $sql);

                    if($result){
                        if(mysqli_num_rows($result) > 0){
                          while($row = mysqli_fetch_assoc($result)){
                                $user_id = $row['user_id'];
                                $username = $row['username'];
                                $fullname = $row['fullname'];
                                $email = $row['email'];

                                $file = "images/users/" . $user_id . "/logo.jpg";
                
                                if(!file_exists($file)){//Deletes the image if it exists
                                    $file = "images/users/" . $user_id . "/logo.png";
                                    if(!file_exists($file)){//Deletes the image if it exists
                                        $file = "images/users/" . $user_id . "/logo.gif";
                                        if(!file_exists($file)){//Deletes the image if it exists
                                            $file = "images/users/default.png";
                                        }
                                    }
                                }

                                echo "<tr><th scope='row'>#$user_id</th>";
                                echo "<td><i class='fa fa-user-alt'>$username</i><br>";
                                echo "<i class='fa fa-envelope'>$email</i><br>";
                                echo "<i class='fa fa-user-alt'>$fullname</i><br></td>";
                                echo "<td><button class='btn btn-primary' data-toggle='modal' data-target='#photo$user_id'>View Photo</button></td>";
                                echo "<td><a href='editUser.php?id=$user_id'><button class='btn btn-primary'>Edit</button></a></td></tr>";

                                echo "<div class='modal fade' id='photo$user_id' tabindex='-1' role='dialog' aria-labelledby='photoLabel' aria-hidden='true'>
                                    <div class='modal-dialog' role='document'>
                                        <div class='modal-content'>
                                        <div class='modal-body'>
                                            <div class='user-photo'>
                                                <img src='$file' alt='User Image'>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>";
                          }
                        }
                    }
                
                ?>
            </tbody>
        </table>
    </div>

    <?php include 'footer.php' ?>
</body>
</html>