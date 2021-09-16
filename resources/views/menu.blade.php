<div>
    @forelse($menu as $item)
        @php($hasChildren = $item->children()->count())
        <div class="nav-item" @if($hasChildren) data-toggle="dropdown" @endif>
            <li class="nav-item {{ $hasChildren ? 'dropdown' : '' }}">
                <a class="nav-link {{ $hasChildren ? 'dropdown-toggle' : '' }}"
                @if($hasChildren)
                    role="button"
                   data-bs-toggle="dropdown"
                   aria-expanded="false"
                   href="#"
                @else
                    href="{{ slug($item->name, app()->getLocale()) }}"
                    @endif
                >
                    {{ $item->name }}
                </a>
                @if($hasChildren)
                    <ul class="dropdown-menu">
                        @forelse($item->children() as $subItem)
                            <li class="dropdown-item">
                                <a class="dropdown-item" href="{{ slug($subItem->menuable->getTranslation('name', app()->getLocale()), app()->getLocale()) }}">
                                    {{ $subItem->menuable->name }}
                                </a>
                            </li>
                        @empty
                        @endforelse
                    </ul>
                @endif
            </li>
        </div>
    @empty
    @endforelse
</div>
