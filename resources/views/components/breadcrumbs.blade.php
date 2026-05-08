@php
    /** @var array<int, array{label: string, url?: string|null}> $items */
    $items = $items ?? [];
@endphp

@if (count($items) > 0)
    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
        <ol class="breadcrumb mb-0">
            @foreach ($items as $item)
                @php
                    $label = $item['label'] ?? '';
                    $url = $item['url'] ?? null;
                    $isLast = $loop->last;
                @endphp

                @if ($isLast)
                    <li class="breadcrumb-item active" aria-current="page">{{ $label }}</li>
                @else
                    <li class="breadcrumb-item">
                        @if ($url)
                            <a href="{{ $url }}">{{ $label }}</a>
                        @else
                            <span>{{ $label }}</span>
                        @endif
                    </li>
                @endif
            @endforeach
        </ol>
    </nav>
@endif

