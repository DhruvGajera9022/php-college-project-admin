<?php

include_once('userdata.php');

// Prepare and execute the SQL statement to fetch all users along with their roles
$query = "SELECT * FROM tbluser";
$stmtUsers = $conn->prepare($query);
if (!$stmtUsers) {
    die("Prepare failed: " . $conn->error);
}
if (!$stmtUsers->execute()) {
    die("Execute failed: " . $stmtUsers->error);
}
$resUsers = $stmtUsers->get_result();

// Set page title and active menu
$title = "Users";
$active = "active";

?>

<?php include_once 'includes/body.php'; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?php echo $title; ?></h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-row-reverse mb-3">
                                <a href="adduser.php" class="btn btn-primary">Add</a>
                            </div>
                            <table id="userstable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Number</th>
                                        <th>Gender</th>
                                        <th>Date of Birth</th>
                                        <th>Hobby</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($dataUser = $resUsers->fetch_assoc()) { ?>
                                        <tr>
                                            <td><?php echo $dataUser['fname']; ?></td>
                                            <td><?php echo $dataUser['lname']; ?></td>
                                            <td><?php echo $dataUser['email']; ?></td>
                                            <td><?php echo $dataUser['number']; ?></td>
                                            <td><?php echo $dataUser['gender']; ?></td>
                                            <td><?php echo $dataUser['dob']; ?></td>
                                            <td><?php echo $dataUser['hobby']; ?></td>
                                            <td><?php echo $dataUser['role']; ?></td>
                                            <td>
                                                <a href="adduser.php?id=<?php echo $dataUser['id']; ?>" class="btn btn-success">Edit</a>
                                                <a href="adduser.php?idd=<?php echo $dataUser['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include_once 'includes/footer.php'; ?>