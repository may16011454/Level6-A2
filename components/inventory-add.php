<?php
// Include the functions file for utility functions
require_once './inc/functions.php';

// Initialize a variable to store any error message from the query string
$message = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : '';

// Fetch the list of suppliers
$suppliers = $controllers->suppliers()->get_all_suppliers();

// Check if the form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Process the submitted form data
  $name = InputProcessor::processString($_POST['name']);
  $description = InputProcessor::processString($_POST['description']);
  $image = InputProcessor::processString($_POST['image']);
  $supplier_id = intval($_POST['supplier_id']);

  // Validate all inputs
  $valid = $name['valid'] && $description['valid'] && $image['valid'];

  // Set an error message if any input is invalid
  $message = !$valid ? "Please fix the above errors:" : '';

  // If all inputs are valid, proceed with adding equipment
  if ($valid) {
    // Prepare the data for adding equipment
    $equipmentData = [
      'name' => $name['value'],
      'description' => $description['value'],
      'image' => $image['value'],
      'supplier_id' => $supplier_id,
    ];

    // Call the create_equipment function to insert data into the database
    $item = $controllers->equipment()->create_equipment($equipmentData);

    // Check if the insertion was successful
    if ($item) {
      // Redirect to avoid form resubmission
      redirect("./admin-equipments.php");
    } else {
      // Set error message if adding equipment fails
      $message = "Failed to add equipment. Please try again.";
    }
  }
}
?>

<!-- HTML form for creating equipment -->
<form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
  <!-- Form content -->
  <section class="vh-100">
    <div class="container py-5 h-75">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card shadow-2-strong" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">

              <h3 class="mb-2">Create Equipment</h3>
              <!-- name input field -->
              <div class="form-outline mb-4">
                <input required type="text" id="name" name="name" class="form-control form-control-lg" placeholder="Equipment Name" required value="<?= htmlspecialchars($name['value'] ?? '') ?>" />
                <!-- Display error message for name -->
                <span class="text-danger"><?= $name['error'] ?? '' ?></span>
              </div>

              <!-- Description input field -->
              <div class="form-outline mb-4">
                <input required type="text" id="description" name="description" class="form-control form-control-lg" placeholder="Description" required value="<?= htmlspecialchars($description['value'] ?? '') ?>" />
                <!-- Display error message for description -->
                <span class="text-danger"><?= $description['error'] ?? '' ?></span>
              </div>

              <div class="form-outline mb-4">
                <input required type="text" id="image" name="image" class="form-control form-control-lg" placeholder="Insert image address" required value="<?= htmlspecialchars($image['value'] ?? '') ?>" />
                <!-- Display error message for image -->
                <span class="text-danger"><?= $image['error'] ?? '' ?></span>
              </div>

              <!-- Supplier Selection Dropdown -->
              <div class="form-group">
                <label for="supplier">Supplier:</label>
                <select class="form-control" id="supplier" name="supplier_id">
                  <?php foreach ($suppliers as $supplier) : ?>
                    <option value="<?= htmlspecialchars($supplier['id']) ?>">
                      <?= htmlspecialchars($supplier['name']) ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
              <!-- Submit button -->
              <button class="btn btn-primary btn-lg w-100 mb-4" type="submit">Submit</button>
              <!-- Display message if set -->
              <?php if ($message) : ?>
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