<?php

include_once('userdata.php');

$upid = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;

if ($upid) {
    $stmt = $conn->prepare("SELECT * FROM tblfeedback WHERE id = ?");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("i", $upid);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows > 0) {
        $data = $res->fetch_assoc();
    }
    $stmt->close();
}

// Initialize an array to store error messages
$error = [];

$NAME = "Edit";

// Handle form submission
if (isset($_POST['Edit'])) {
    $email = $_POST['email'];
    $feedback = $_POST['feedback'];

    $error = [];
    if (empty($feedback)) {
        $error['feedback'] = "Enter Feedback";
    }

    if (empty($error)) {
        $stmt = $conn->prepare("UPDATE tblfeedback SET email = ?, feedback = ? WHERE id = ?");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("ssi", $email, $feedback, $upid);

        if ($stmt->execute()) {
            header("Location: feedback.php");
            exit;
        } else {
            $error['db_error'] = "Database error: Failed to update";
        }
        $stmt->close();
    }
}

//Handel delete record
if (isset($_REQUEST['idd'])) {
    $id = $_GET['idd'];

    $query = "DELETE FROM tblfeedback WHERE id = '$id' ";
    $result = mysqli_query($conn, $query);

    if ($result) {
        header('location: feedback.php');
    }
}


// Set the page title
$title = "Feedback";
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
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title"><?php echo $NAME; ?></h3>
                                </div>
                                <!-- /.card-header -->

                                <!-- form start -->
                                <form method="post" id="formAddRole">
                                    <?php if (!empty($error)) : ?>
                                        <div class="alert alert-danger">
                                            <?php foreach ($error as $err) : ?>
                                                <p><?php echo $err; ?></p>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="email">Role Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email" value="<?php echo $data['email']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="feedback">Feedback</label>
                                            <textarea name="feedback" class="form-control" id="feedback" placeholder="Enter Feedback"><?php echo $data['feedback']; ?></textarea>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" name="<?php echo $NAME; ?>" class="btn btn-primary">
                                            <?php echo $NAME; ?></button>
                                    </div>
                                </form>

                                <?php if (isset($error['db_error'])): ?>
                                    <div class="alert alert-danger mt-2"><?php echo $error['db_error']; ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include_once 'includes/footer.php'; ?>