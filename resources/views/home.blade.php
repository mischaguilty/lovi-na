@section('title', 'Home')

<div class="d-grid mx-auto">
    <h1>
        {{ $company->name }}
    </h1>
    <form wire:submit.prevent="save">

    @forelse($company->translatable as $property)
        @forelse(\Mcamara\LaravelLocalization\Facades\LaravelLocalization::getSupportedLanguagesKeys() as $locale)
            <label for="{{ implode('.', [$property, $locale]) }}">
                {{ implode('_', [__($property), $locale]) }}
            </label>
            <input type="text" class="form-control" wire:model.defer="{{ $property }}.{{ $locale }}" id="{{ implode('.', [$property, $locale]) }}" name="{{ implode('.', [$property, $locale]) }}">
        @empty
        @endforelse
    @empty
    @endforelse

    <label for="logo">
        {{ __('Logo') }}
    </label>
        @if($pic = $company->getFirstMedia('logo'))
            <button type="button" wire:click="resetLogo">
            <img src="{{ $pic->getFullUrl() }}" alt="{{ $pic->name }}" width="200" height="auto"/>
            </button>
        @else
    <input type="file" class="form-control" wire:model=logo id="logo" name="logo">
    @endif
    <div class="d-inline justify-content-between">
        <button type="button" class="btn btn-primary" wire:click.prevent="save">{{ __('Save') }}</button>
    </div>
    </form>
</div>
