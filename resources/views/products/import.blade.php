<div>
    <div wire:loading="imported">{{ __('!!!!!!!!!!!!!!!!!!!!!!!') }}</div>
    <select class="form-control" wire:model="importableClass" name="importableClass" id="importableClass">
        <option value="">{{ __('Класс для импорта') }}</option>
        @forelse($importables as $name => $class)
            <option value="{{ $class  }}">{{ $name }}</option>
        @empty
        @endforelse
    </select>

    <input type="file" class="form-control" wire:model="file" />

    @forelse($imported as $item)
        <div class="list-group border my-2">
            <div class="list-item">
                <div class="d-inline-flex justify-content-between">
                    <span>{{ __('Строка') }} {{ $loop->index + 1 }}</span>
                    <button type="button" class="btn btn-danger" wire:click="removeItem({{ $loop->index }})">
                        <i class="fa fa-cross"></i>
                    </button>
                </div>

            @forelse($item as $key => $value)
                    <div class="card">
                        <div class="card-header ">
                            <span>{{ $key }}</span>
                            <strong>{{ $value }}</strong>
                        </div>
                    </div>
            @empty
            @endforelse
            </div>
        </div>
    @empty
    @endforelse
</div>
