<?php
$message = '';

require_once './inc/functions.php';
$supplierController = $controllers->suppliers();

// Check if the action is 'edit' and a supplier ID is provided
if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
    $supplierId = intval($_GET['id']);

    // Fetch the supplier details
    $supplierDetails = $supplierController->get_supplier_by_id($supplierId);

    // Check if the supplier exists
    if ($supplierDetails) {
        // Render the edit form
        ?>
        <div class="container mt-4">
            <h2>Edit Supplier</h2>

            <!-- Display any error messages here -->
            <?php if ($message): ?>
                <div class="alert alert-danger" role="alert">
                    <?= $message ?>
                </div>
            <?php endif; ?>

            <form method="post" action="admin-suppliers.php?action=update">
                <input type="hidden" name="id" value="<?= $supplierDetails['id'] ?>">

                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name"
                        value="<?= htmlspecialchars($supplierDetails['name']) ?>">
                </div>

                <div class="form-group">
                    <label for="contact_email">Contact Email:</label>
                    <input type="text" class="form-control" id="contact_email" name="contact_email"
                        value="<?= htmlspecialchars($supplierDetails['contact_email']) ?>">
                </div>

                <button type="submit" class="btn btn-primary">Update Supplier</button>
            </form>

        </div>
        <?php
        exit(); // Stop further execution to avoid rendering the supplier list
    } else {
        // Redirect to the supplier list with an error message
        redirect('./admin-suppliers.php?error=Supplier not found.');
    }
}
?>
