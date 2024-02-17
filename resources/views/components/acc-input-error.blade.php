@props(['for'])

<div>
    @error($for)
        <span class="text-danger text-sm">{{ $message }}</span>
    @enderror
</div>
