<?php
require_once './inc/functions.php';

// Initialize a variable to store any error message from the query string
$message = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : '';

// Check if the form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Process the submitted form data
    $firstname = InputProcessor::processString($_POST['firstname']);
    $lastname = InputProcessor::processString($_POST['lastname']);
    $email = InputProcessor::processString($_POST['email']);
    $password = InputProcessor::processString($_POST['password']); 

    // Validate all inputs
    $valid = $firstname['valid'] && $lastname['valid'] && $email['valid'] && $password['valid'];

    // Set an error message if any input is invalid
    $message = !$valid ? "Please fix the above errors:" : '';

    if ($valid) {
        $userData = [
            'firstname' => $firstname['value'],
            'lastname' => $lastname['value'],
            'email' => $email['value'],
            'password' => password_hash($password['value'], PASSWORD_BCRYPT), // Hash the password
        ];

        // Call the create_member function to insert data into the database
        $user = $controllers->members()->register_member($userData);

        // Check if the insertion was successful
        if ($user) {
            redirect("./admin-members.php");
        } else {
            // Set error message if adding user fails
            $message = "Failed to add user. Please try again.";
        }
    }
}
?>

<!-- HTML form for adding users -->
<form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
    <!-- Form content -->
    <section class="vh-100">
        <div class="container py-5 h-75">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">

                            <h3 class="mb-2">Add User</h3>
                            <div class="form-outline mb-4">
                                <input required type="text" id="firstname" name="firstname" class="form-control form-control-lg" placeholder="First Name" required value="<?= htmlspecialchars($firstname['value'] ?? '') ?>" />
                                <span class="text-danger"><?= $firstname['error'] ?? '' ?></span>
                            </div>

                            <div class="form-outline mb-4">
                                <input required type="text" id="lastname" name="lastname" class="form-control form-control-lg" placeholder="Last Name" required value="<?= htmlspecialchars($lastname['value'] ?? '') ?>" />
                                <span class="text-danger"><?= $lastname['error'] ?? '' ?></span>
                            </div>

                            <div class="form-outline mb-4">
                                <input required type="email" id="email" name="email" class="form-control form-control-lg" placeholder="Email" required value="<?= htmlspecialchars($email['value'] ?? '') ?>" />
                                <span class="text-danger"><?= $email['error'] ?? '' ?></span>
                            </div>

                            <div class="form-outline mb-4">
                                <input required type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Password" required />
                                <span class="text-danger"><?= $password['error'] ?? '' ?></span>
                            </div>

                            <button class="btn btn-primary btn-lg w-100 mb-4" type="submit">Submit</button>
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
