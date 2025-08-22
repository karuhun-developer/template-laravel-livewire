@props([
    'url' => '#',
    'label' => 'Back',
])
<div>
    <a href="{{ $url }}" class="btn bg-gradient-dark btn-sm mb-0">
        <i class="fas fa-arrow-left me-2"></i>
        {{ $label }}
    </a>
</div>
