

<x-badge  theme="{{ ($attributes['status'] === '1') ? 'success' : 'light' }}">
    {{ ($attributes['status'] === '1') ? 'Ativo' : 'Inativo' }}
</x-badge>


