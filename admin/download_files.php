<?php
require_once("../database/database_library.php");
if (!($_SESSION['user']['role_type']=="admin")) {
    session_destroy();
    header("location:../login.php?class=danger&msg=Unauthorized access");
}
$dobj = new database_library();

if (isset($_REQUEST['action'])&&$_REQUEST['action']=='downloadexcel') {
    header("Content-Type:application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=user_data.xls");
    header("Cache-Control: no-cache, no-store, must-revalidate");
    header("Pragma:no-cache");
    header("Expires:0");
?>
<table class="table table-success">
            <thead>
            <tr class="bg-secondary text-success">
            <th scope="col">User id</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Gender</th>
            <th scope="col">Date of Birth</th>
            <th scope="col">Home Town</th>
            <th scope="col">Email</th>
            <th scope="col">Is approved?</th>
            </tr>
            </thead>
            <tbody>
                <?php  
                $result = $dobj->show_all_users();
                if ($result->num_rows) {
                    while($row = mysqli_fetch_assoc($result)){
                 ?>
                <tr>
                    <td> <?php echo $row['user_id']; ?></td>
                    <td> <?php echo $row['first_name']; ?></td>
                    <td> <?php echo $row['last_name']; ?></td>
                    <td> <?php echo $row['gender']; ?></td>
                    <td> <?php echo $row['date_of_birth']; ?></td>
                    <td> <?php echo $row['home_town'];  ?></td>
                    <td> <?php echo $row['email']; ?> </td>
                    <td> <?php echo $row['is_approve']; ?> </td>
                </tr>
            <?php }
        }
             ?>
            </tbody>
            </table>

<?php
}

else if (isset($_REQUEST['action']) && $_REQUEST['action']=='downloadpdf') {
    header("Content-Type:application/vnd-ms-word");
    header("Content-Disposition: attachment; filename=user_data.doc");
    header("Cache-Control: no-cache, no-store, must-revalidate");
    header("Pragma:no-cache");
    header("Expires:0");
    ?>
<table class="table table-success">
            <thead>
            <tr class="bg-secondary text-success">
            <th scope="col">User id</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Gender</th>
            <th scope="col">Date of Birth</th>
            <th scope="col">Home Town</th>
            <th scope="col">Email</th>
            <th scope="col">Is approved?</th>
            </tr>
            </thead>
            <tbody>
                <?php  
                $result = $dobj->show_all_users();
                    // print_r($result);
                    // die();
                if ($result->num_rows) {
                    while($row = mysqli_fetch_assoc($result)){
                 ?>
                <tr>
                    <td> <?php echo $row['user_id']; ?></td>
                    <td> <?php echo $row['first_name']; ?></td>
                    <td> <?php echo $row['last_name']; ?></td>
                    <td> <?php echo $row['gender']; ?></td>
                    <td> <?php echo $row['date_of_birth']; ?></td>
                    <td> <?php echo $row['home_town'];  ?></td>
                    <td> <?php echo $row['email']; ?> </td>
                    <td> <?php echo $row['is_approve']; ?> </td>
                </tr>
                <?php 
            }
                }
                 ?>
            </tbody>
            </table>

<?php
}
