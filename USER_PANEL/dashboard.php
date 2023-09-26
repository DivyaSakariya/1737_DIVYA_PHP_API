<?php

    include("config/config.php");

    $config = new Config();

    $config->connectServer();

    $res = $config->getAllData();

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    </head>
    <body>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

       <div class="container pt=5">
            <table class="table caption-top">
                <caption>List of users</caption>
                <thead>
                    <tr>
                        <th scope="col">Gr. No.</th>
                        <th scope="col">Name</th>
                        <th scope="col">Age</th>
                        <th scope="col">Course</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($record = mysqli_fetch_assoc($res)) { ?>
                    <tr>
                        <th scope="row"><?php echo $record['Id'] ;?></th>
                        <td><?php echo $record['Name'];?></td>
                        <td><?php echo $record['Age'];?></td>
                        <td><?php echo $record['Course'];?></td>
                    </tr>   
                    <?php } ?>         
                </tbody>
            </table>
       </div>
    </body>
</html>