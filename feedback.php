<?php

include_once('userdata.php');

// Fetch the role tables value and display in table
$query = "SELECT * FROM tblfeedback";
$stmtRole = $conn->prepare($query);
if (!$stmtRole) {
    die("Prepare failed: " . $conn->error);
}
if (!$stmtRole->execute()) {
    die("Execute failed: " . $stmtRole->error);
}
$resRoles = $stmtRole->get_result();


$title = "Feedback";

?>

<?php include_once 'includes/body.php'; ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Feedback</h1>
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
                            <table id="tablerole" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Email</th>
                                        <th>Feedback</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($dataRole = $resRoles->fetch_assoc()) { ?>
                                        <tr>
                                            <td><?php echo $dataRole['email']; ?></td>
                                            <td><?php echo $dataRole['feedback']; ?></td>
                                            <td>
                                                <a href="editfeedback.php?id=<?php echo $dataRole['id']; ?>" class="btn btn-success">Edit</a>
                                                <a href="editfeedback.php?idd=<?php echo $dataRole['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
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