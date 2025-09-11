<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-primary text-white rounded-top-4">
            <h4 class="mb-0">{{ __('edit_privacy_policy') }}</h4>
        </div>
        <div class="card-body p-4">
            <!-- Success Message -->
            <div id="successMessage" class="alert alert-success d-none"></div>

            <form id="privacyForm">
                <div class="form-group mb-3">
                    <label for="content" class="form-label">{{ __('privacy_policy') }}</label>
                    <textarea id="content" name="content" rows="10" class="form-control" required></textarea>
                    <div id="errorMessage" class="text-danger mt-1 d-none">{{ __('privacy_policy_required') }}</div>
                </div>

                <button type="submit" class="btn btn-success px-4">{{ __('save') }}</button>
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
            successMessage.textContent = "{{ __('privacy_policy_updated') }}";
            successMessage.classList.remove("d-none");
            form.reset();
        }
    });
</script>
