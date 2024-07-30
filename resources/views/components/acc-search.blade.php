<div>
    <div class="input-group">
        <span class="input-group-text" id="search-icon">
            <i class="fa fa-search"></i>
        </span>
        <input wire:model.live.debounce.250="search" type="text" class="form-control" aria-label="Search" aria-describedby="search-icon" placeholder="Search...">
    </div>
</div>
