<?php

include_once('userdata.php');

// Fetch the policy tables value and display in table
$query = "SELECT * FROM tblpolicy";
$stmt = $conn->prepare($query);
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}
if (!$stmt->execute()) {
    die("Execute failed: " . $stmt->error);
}
$resPolicies = $stmt->get_result();

$title = "Policy";

?>

<?php include_once 'includes/body.php'; ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Policy</h1>
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
                            <div class="d-flex flex-row-reverse"><a href="addpolicy.php" class="btn btn-primary">Add</a></div>
                            <table id="tablerole" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Policy Name</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($data = $resPolicies->fetch_assoc()) { ?>
                                        <tr>
                                            <td><?php echo $data['name']; ?></td>
                                            <td><?php echo $data['description']; ?></td>
                                            <td>
                                                <a href="addpolicy.php?id=<?php echo $data['id']; ?>" class="btn btn-success">Edit</a>
                                                <a href="addpolicy.php?idd=<?php echo $data['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
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