<div>
    <input type="file" class="form-control" wire:model="file" />

    @forelse($imported as $item)
        <div class="list-group border my-2">
            @forelse($item as $value)
                <span>{{ $value }}</span>
            @empty
            @endforelse
        </div>
    @empty
    @endforelse
</div>
