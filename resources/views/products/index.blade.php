<div>
    <form wire:submit.prevent="search">
        <input type="search" class="form-control" wire:model.debounce.500ms="search">
    </form>

   @forelse($products as $product)
       <div>{{ $product->name }}</div>
    @empty
    @endforelse
    {{ $products->links() }}
</div>
