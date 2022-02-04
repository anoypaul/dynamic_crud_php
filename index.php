<?php 
    include("function.php");
    $objCrudAdmin = new crudApp();
    if (isset($_POST['add_info'])) {
        $return_msg = $objCrudAdmin->add_data($_POST);
    }

    $students = $objCrudAdmin->display_data();

    if(isset($_GET['status'])){
        if ($_GET['status']='delete') {
            $delete_id = $_GET['id'];
            $delmsg = $objCrudAdmin->delete_data($delete_id);
        }
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Dynamic crud application with raw php</title>
  </head>
  <body>
    <div class="wrapper">
        <div class="container my-4 p-4 shadow">
            <h2><a href="index.php" style="text-decoration: none;">Student Database</a></h2>
            <?php if (isset($delmsg)) {
                    echo $delmsg;
            } ?>
            <form class="form" action="" method="post" enctype="multipart/form-data">
                <?php if (isset($return_msg)) {
                    echo $return_msg;
                } ?>
                    <input class="form-control mb-3" type="text" name="std_name" placeholder="Enter Your Name">
                    <input class="form-control mb-3" type="number" name="std_roll" placeholder="Enter Your Roll">
                    <label for="image">Upload your image</label>
                    <input class="form-control mb-3" type="file" name="std_img">
                    <input type="submit" class="form-control bg-warning mb-3" value="Update Information" name="add_info" >
                    <!-- <button type="submit" class="form-control bg-warning mb-3" name="std_img">Add Information</button> -->
            </form>
        </div>
    </div>
        <div class="container my-4 p-4 shadow">
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Roll</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $serial = 1;
                    while($student=mysqli_fetch_assoc($students)){ ?>
                    <tr>
                    
                        <td><?php echo $serial++ ?></td>
                        <td><?php echo $student['students_name'] ?></td>
                        <td><?php echo $student['students_roll'] ?></td>
                        <td><img src="upload/<?php echo $student['students_image']?> " style="width: 70px; height:60px; "></td>
                        <td>
                            <a class="btn btn-success" href="edit.php?status=edit&&id=<?php echo $student['students_id']; ?>">Edit</a>
                            <a class="btn btn-warning" href="?status=delete&&id=<?php echo $student['students_id']; ?>">Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>