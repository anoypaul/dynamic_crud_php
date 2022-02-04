<?php 
    include("function.php");
    $objCrudAdmin = new crudApp();
    $students = $objCrudAdmin->display_data();
    if (isset($_GET['status'])) {
        if ($_GET['status']='edit') {
            $id = $_GET['id'];
            $returndata = $objCrudAdmin->display_data_by_id($id);
        }
    }
    if (isset($_POST['edit_btn'])) {
        $msg = $objCrudAdmin->update_data($_POST);
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
            <form class="form" action="" method="post" enctype="multipart/form-data">
                <?php if (isset($msg)) {
                    echo $msg;
                } ?>
                    <input class="form-control mb-3" type="text" name="u_std_name" value="<?php echo $returndata['students_name']; ?>">
                    <input class="form-control mb-3" type="number" name="u_std_roll" value="<?php echo $returndata['students_roll']; ?>">
                    <label for="image">Upload your image</label>
                    <input class="form-control mb-3" type="file" name="u_std_img" value="<?php echo $returndata['students_image']; ?>">
                    <input type="hidden" name="std_id" value="<?php echo $returndata['students_id']; ?>">
                    <input type="submit" class="form-control bg-warning mb-3" value="Add Information" name="edit_btn" >
                    <!-- <button type="submit" class="form-control bg-warning mb-3" name="std_img">Add Information</button> -->
            </form>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>