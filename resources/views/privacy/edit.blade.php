<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Privacy Policy</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-header bg-primary text-white rounded-top-4">
                <h4 class="mb-0">Edit Privacy Policy</h4>
            </div>
            <div class="card-body p-4">
                <!-- Success Message -->
                <div id="successMessage" class="alert alert-success d-none"></div>

                <form id="privacyForm">
                    <div class="form-group mb-3">
                        <label for="content" class="form-label">Privacy Policy</label>
                        <textarea id="content" name="content" rows="10" class="form-control" required></textarea>
                        <div id="errorMessage" class="text-danger mt-1 d-none">Privacy policy field shouldn’t be empty.</div>
                    </div>

                    <button type="submit" class="btn btn-success px-4">Save</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        const form = document.getElementById('privacyForm');
        const content = document.getElementById('content');
        const errorMessage = document.getElementById('errorMessage');
        const successMessage = document.getElementById('successMessage');

        form.addEventListener('submit', function(event) {
            event.preventDefault();

            if (content.value.trim() === "") {
                errorMessage.classList.remove("d-none");
                successMessage.classList.add("d-none");
            } else {
                errorMessage.classList.add("d-none");
                successMessage.textContent = "Privacy Policy updated successfully!";
                successMessage.classList.remove("d-none");
                form.reset();
            }
        });
    </script>
</body>
</html>
