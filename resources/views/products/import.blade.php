<div>
    <input type="file" class="form-control" wire:model="file" />

    @forelse($imported as $item)
        <div class="list-group border my-2">
            <div class="list-item">
                <span>{{ $loop->index }}</span>
            @forelse($item as $key => $value)
                    <div class="d-inline-flex">
                        <span>{{ $key }}</span> - <strong>{{ $value }}</strong>
                    </div>
            @empty
            @endforelse
            </div>
        </div>
    @empty
    @endforelse
</div>
