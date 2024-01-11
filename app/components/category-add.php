<?php
// Include the functions file for utility functions
require_once './inc/functions.php';

// Retrieve the CategoryController instance
$categoryController = $controllers->categories();

// Initialize a variable to store any error message from the query string
$message = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : '';

// Check if the form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Process the submitted form data
    $name = InputProcessor::processString($_POST['name']);

    // Validate the input
    $valid = $name['valid'];

    // Set an error message if the input is invalid
    $message = !$valid ? "Please fix the above errors:" : '';

    // If the input is valid, proceed with adding a category
    if ($valid) {
        // Prepare the data for adding a category
        $categoryData = [
            'name' => $name['value'],
        ];

        // Call the create_category function to insert data into the database
        $item = $categoryController->create_category($categoryData);

        // Check if the insertion was successful
        if ($item) {
            // Redirect or show a success message
            redirect("./admin-category.php");
        } else {
            // Set error message if adding a category fails
            $message = "Failed to add category. Please try again.";
        }
    }
}
?>

<!-- HTML form for adding a category -->
<form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
    <!-- Form content -->
    <section class="vh-100">
        <div class="container py-5 h-75">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">

                            <h3 class="mb-2">Add Category</h3>
                            <div class="form-outline mb-4">
                                <input required type="text" id="name" name="name" class="form-control form-control-lg" placeholder="Category Name" required value="<?= htmlspecialchars($name['value'] ?? '') ?>"/>
                                <!-- Display error message for name -->
                                <span class="text-danger"><?= $name['error'] ?? '' ?></span>
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
