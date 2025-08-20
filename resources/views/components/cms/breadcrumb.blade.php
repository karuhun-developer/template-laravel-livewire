@props([
    'items' => []
])
{{-- [
    'label' => 'Pages',
    'url' => '#',
    'active' => false,
], --}}
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        @foreach ($items as $item)
            <li class="breadcrumb-item text-sm {{ $item['active'] ? 'text-dark active' : 'text-secondary' }}"
                aria-current="{{ $item['active'] ? 'page' : '' }}">
                <a class="{{ $item['active'] ? 'text-dark' : 'opacity-5 text-dark' }}"
                    href="{{ $item['url'] }}">
                    {{ $item['label'] }}
                </a>
            </li>
        @endforeach
    </ol>
</nav>
