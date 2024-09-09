<?php

include_once('userdata.php');

// Fetch the role tables value and display in table
$query = "SELECT * FROM tblcomputercategory";
$stmtCategory = $conn->prepare($query);
if (!$stmtCategory) {
    die("Prepare failed: " . $conn->error);
}
if (!$stmtCategory->execute()) {
    die("Execute failed: " . $stmtCategory->error);
}
$resCategory = $stmtCategory->get_result();


$title = "Category";

?>

<?php include_once 'includes/body.php'; ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Category</h1>
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
                                <a href="addcategory.php" class="btn btn-primary">Add</a>
                            </div>
                            <table id="tablerole" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Category</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($dataCategory = $resCategory->fetch_assoc()) { ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($dataCategory['name']); ?></td>
                                            <td><?php echo htmlspecialchars($dataCategory['description']); ?></td>
                                            <td>
                                                <a href="addcategory.php?id=<?php echo $dataCategory['id']; ?>" class="btn btn-success">Edit</a>
                                                <a href="addcategory.php?idd=<?php echo $dataCategory['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
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