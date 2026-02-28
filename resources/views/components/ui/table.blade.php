@props([
    'headers' => [],
    'striped' => false,
    'hoverable' => true,
    'responsive' => true
])

@php
    $tableClasses = 'table';
    if ($striped) $tableClasses .= ' table-striped';
    if ($hoverable) $tableClasses .= ' table-hover';
@endphp

@if($responsive)
    <div class="table-responsive">
@endif

    <table {{ $attributes->merge(['class' => $tableClasses]) }}>
        @if(!empty($headers))
            <thead>
                <tr>
                    @foreach($headers as $header)
                        <th>{{ $header }}</th>
                    @endforeach
                </tr>
            </thead>
        @endif

        <tbody>
            {{ $slot }}
        </tbody>
    </table>

@if($responsive)
    </div>
@endif
