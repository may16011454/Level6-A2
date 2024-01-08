<?php
// Include the functions file for utility functions
require_once './inc/functions.php';

// Retrieve the SupplierController instance
$supplierController = $controllers->suppliers();

// Initialize a variable to store any error message from the query string
$message = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : '';

// Check if the form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Process the submitted form data
    $name = InputProcessor::processString($_POST['name']);
    $contactEmail = InputProcessor::processString($_POST['contact_email']);

    // Validate all inputs
    $valid = $name['valid'] && $contactEmail['valid'];

    // Set an error message if any input is invalid
    $message = !$valid ? "Please fix the above errors:" : '';

    // If all inputs are valid, proceed with adding a supplier
    if ($valid) {
        // Prepare the data for adding a supplier
        $supplierData = [
            'name' => $name['value'],
            'contact_email' => $contactEmail['value'],
        ];

        // Call the create_supplier function to insert data into the database
        $item = $supplierController->create_supplier($supplierData);

        // Check if the insertion was successful
        if ($item) {
            // Redirect or show a success message
            redirect("./admin-suppliers.php");
        } else {
            // Set error message if adding a supplier fails
            $message = "Failed to add supplier. Please try again.";
        }
    }
}
?>

<!-- HTML form for adding a supplier -->
<form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
    <!-- Form content -->
    <section class="vh-100">
        <div class="container py-5 h-75">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">

                            <h3 class="mb-2">Add Supplier</h3>
                            <!-- Name input field -->
                            <div class="form-outline mb-4">
                                <input required type="text" id="name" name="name" class="form-control form-control-lg" placeholder="Supplier Name" required value="<?= htmlspecialchars($name['value'] ?? '') ?>"/>
                                <!-- Display error message for name -->
                                <span class="text-danger"><?= $name['error'] ?? '' ?></span>
                            </div>

                            <!-- Contact Email input field -->
                            <div class="form-outline mb-4">
                                <input required type="text" id="contact_email" name="contact_email" class="form-control form-control-lg" placeholder="Contact Email" required value="<?= htmlspecialchars($contactEmail['value'] ?? '') ?>"/>
                                <!-- Display error message for contact_email -->
                                <span class="text-danger"><?= $contactEmail['error'] ?? '' ?></span>
                            </div>

                            <!-- Submit button -->
                            <button class="btn btn-primary btn-lg w-100 mb-4" type="submit">Submit</button>
                            <!-- Display message if set -->
                            <?php if ($message): ?>
                                <div class="alert alert-danger mt-4" role="alert">
                                    <?= $message ?? '' ?>
                                </div>
                            <?php endif ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>

<?php require __DIR__ . "/inc/footer.php"; ?>
