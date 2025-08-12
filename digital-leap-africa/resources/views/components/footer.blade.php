<footer class="bg-primary-light border-t border-gray-700 mt-auto">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
            <p class="text-sm text-gray-400">
                {{ $siteSettings['footer_text'] ?? '' }}
            </p>
            <div class="flex space-x-6">
                <a href="{{ $siteSettings['privacy_policy_url'] ?? '#' }}" class="text-gray-400 hover:text-white">Privacy Policy</a>
                <a href="{{ $siteSettings['terms_of_service_url'] ?? '#' }}" class="text-gray-400 hover:text-white">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>