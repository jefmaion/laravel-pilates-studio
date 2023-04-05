<nav aria-label="breadcrumb ">
    <ol {{ $attributes->merge(['class' => 'breadcrumb bg-transparent float-right']) }}>
        <x-breadcrumb-item >Home</x-breadcrumb-item>
        {{ $slot }}
    </ol>
</nav>