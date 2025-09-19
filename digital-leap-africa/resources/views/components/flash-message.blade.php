@if (session('success'))
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1080;">
        <div id="flashSuccess" class="alert alert-success alert-dismissible fade show shadow" role="alert">
            <div class="d-flex align-items-center">
                <!-- Checkmark Icon -->
                <svg class="me-2" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <strong>{{ session('success') }}</strong>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    <script>
        window.addEventListener('DOMContentLoaded', function () {
            const el = document.getElementById('flashSuccess');
            if (!el) return;
            setTimeout(() => {
                const alert = bootstrap.Alert.getOrCreateInstance(el);
                alert.close();
            }, 5000);
        });
    </script>
@endif

{{-- You can add more blocks for session('error'), session('warning'), etc. using alert-danger, alert-warning, etc. --}}