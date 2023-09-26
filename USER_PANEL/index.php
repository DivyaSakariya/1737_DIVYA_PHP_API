<?php

    include("config/config.php");

    $configObj = new Config();

    $configObj->connectServer();

    $submit_btn = null;

    $submit_btn = @$_REQUEST['sbm_btn'];

    $res = null;

    if(isset($submit_btn)) {

        $name = $_POST['fname'];
        $age = $_POST['age'];
        $course = $_POST['course'];
        

        $configObj->insertTable($name, $age, $course);

        // header("Location: dashboard.php");

    }
    

    $delete_btn = @$_REQUEST['delete_btn'];

    if(isset($delete_btn)) {
        $id = $_POST['delete_id'];

        $configObj->deleteSingleData($id);
    }

    $update_btn = @$_REQUEST['update_btn'];
    $fetch_single_record = null;

    if(isset($update_btn)) {
        $id = $_POST['update_id'];

        $res = $configObj->fetchSingleData($id);
        $fetch_single_record = mysqli_fetch_assoc($res);
    }

    $upd_btn = @$_REQUEST['upd_btn'];

    if(isset($upd_btn)) {
        $id = $_POST['upd_id'];
        $name = $_POST['fname'];
        $age = $_POST['age'];
        $course = $_POST['course'];

        $configObj->updateData($id,$name,$age,$course);

    }

    $responce = $configObj->getAllData();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <center><h1>PHP Form</h1></center>
        <hr>
        <div class="container">
            <?php if($submit_btn != null) { ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!!</strong> One row inserted.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria- label="Close"></button>
                </div>
            <?php } else if($submit_btn == null) { ?>
                <div></div>
            <?php } else { ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Dismiss!!</strong> Row can't be inserted.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } ?>
        </div>

        <div class="container">
        <form action="" method="post">
                <input type="hidden" name="upd_id" value="<?php if($fetch_single_record != null){ echo $fetch_single_record['Id'];}?>">
                <div class="mb-3">
                    <label for="fname" class="form-label">Name:</label>
                    <input type="text" name="fname" class="form-control" id="" placeholder="Enter Name..." value="<?php if($fetch_single_record != null) {echo $fetch_single_record['Name'];}?>">
                </div>
                <div class="mb-3">
                    <label for="age" class="form-label">Age:</label>
                    <input type="text" name="age" class="form-control" id="" placeholder="Enter Age..." value="<?php if($fetch_single_record != null) {echo $fetch_single_record['Age'];}?>">
                </div>
                <div class="mb-3">
                    <label for="course" class="form-label">Course:</label>
                    <input type="text" name="course" class="form-control" id="" placeholder="Enter Course..." value="<?php if($fetch_single_record != null) {echo $fetch_single_record['Course'];}?>">
                </div>
                <input type="submit" class="btn btn-outline-success" name="<?php if($fetch_single_record != null) { echo "upd_btn";} else {echo "sbm_btn";}?>" value="<?php if($fetch_single_record != null) { echo "Update";} else {echo "Submit";}?>"></input>
            </form>
        </div>

        <div class="container">
            <table class="table caption-top">
                <thead>
                    <tr>
                        <th scope="col">Gr. No.</th>
                        <th scope="col">Name</th>
                        <th scope="col">Age</th>
                        <th scope="col">Course</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($record = mysqli_fetch_assoc($responce)) { ?>
                    <tr> 
                        <th scope="row"><?php echo $record['Id'] ;?></th>
                        <td><?php echo $record['Name'];?></td>
                        <td><?php echo $record['Age'];?></td>
                        <td><?php echo $record['Course'];?></td>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="update_id" value=<?php echo $record['Id'] ;?>>
                                <input type="submit" class="btn btn-outline-warning" name="update_btn" value="Update"></input>
                            <!-- </form>
                            <form action="" methid="post"> -->
                                <input type="hidden" name="delete_id" value = <?php echo $record['Id'] ;?>>
                                <input type="submit" class="btn btn-outline-danger" name="delete_btn" value="Delete"></input>
                            </form>
                        </td>
                    </tr>   
                    <?php } ?>         
                </tbody>
            </table>
        </div>
</body>
</html>