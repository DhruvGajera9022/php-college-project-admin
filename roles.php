<?php

include_once('userdata.php');

// Fetch the role tables value and display in table
$query = "SELECT * FROM tblrole";
$stmtRole = $conn->prepare($query);
if (!$stmtRole) {
    die("Prepare failed: " . $conn->error);
}
if (!$stmtRole->execute()) {
    die("Execute failed: " . $stmtRole->error);
}
$resRoles = $stmtRole->get_result();

$title = "Role";

?>

<?php include_once 'includes/body.php'; ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Role</h1>
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
                            <div class="d-flex flex-row-reverse">
                                <a href="addrole.php" class="btn btn-primary">Add</a>
                            </div>
                            <table id="tablerole" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Role Name</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($dataRole = $resRoles->fetch_assoc()) { ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($dataRole['name']); ?></td>
                                            <td><?php echo htmlspecialchars($dataRole['description']); ?></td>
                                            <td>
                                                <a href="addrole.php?id=<?php echo $dataRole['id']; ?>" class="btn btn-success">Edit</a>
                                                <a href="addrole.php?idd=<?php echo $dataRole['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
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