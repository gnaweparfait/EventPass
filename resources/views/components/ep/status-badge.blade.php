@props(['status'])

@php
    use App\Enums\EventStatus;
    $class = match ($status) {
        EventStatus::Published => 'ep-badge ep-badge-published',
        EventStatus::Cancelled => 'ep-badge ep-badge-cancelled',
        default => 'ep-badge ep-badge-draft',
    };
    $label = $status instanceof EventStatus ? $status->label() : $status;
@endphp

<span {{ $attributes->merge(['class' => $class]) }}>{{ $label }}</span>
