@php
    /** @var array<int, array{label: string, url?: string|null}> $items */
    $items = $items ?? [];

    /** @var string|null $title */
    $title = $title ?? null;

    /** @var string|null $subtitle */
    $subtitle = $subtitle ?? null;
@endphp

@if (count($items) > 0)
    <div class="page-title">
        <div class="row">
            @if ($title)
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>{{ $title }}</h3>
                    @if ($subtitle)
                        <p class="text-subtitle text-muted">{{ $subtitle }}</p>
                    @endif
                </div>
            @endif
            <div class="col-12 {{ $title ? 'col-md-6 order-md-2 order-first' : 'col-md-12' }}">
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
            </div>
        </div>
    </div>
@endif

