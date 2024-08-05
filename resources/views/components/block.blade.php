<div class="mt-4 p-2 bg-secondary text-white rounded">
    @isset($heading)
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ $heading }}
        </h2>
    @endisset
    {{ $slot }}
</div>