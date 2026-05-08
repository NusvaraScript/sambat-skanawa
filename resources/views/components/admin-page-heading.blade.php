@php
    /** @var string $title */
    /** @var string|null $subtitle */
    /** @var array<int, array{label: string, url?: string|null}> $breadcrumbs */
    $title = $title ?? '';
    $subtitle = $subtitle ?? null;
    $breadcrumbs = $breadcrumbs ?? [];
@endphp

<div class="page-title mb-3">
    <div class="row align-items-start g-2">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3 class="mb-1">{{ $title }}</h3>
            @if ($subtitle)
                <p class="text-subtitle text-muted mb-0">{{ $subtitle }}</p>
            @endif
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            @include('components.breadcrumbs', ['items' => $breadcrumbs])
        </div>
    </div>

    @isset($actions)
        <div class="d-flex justify-content-end gap-2 mt-3">
            {{ $actions }}
        </div>
    @endisset
</div>

