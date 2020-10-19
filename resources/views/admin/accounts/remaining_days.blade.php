@php
    $remainingDays = $account->remainingDays();
@endphp

@switch($remainingDays)

    @case('unlimited')
        <span class="m-badge m-badge--success m-badge--wide" style="font-size:15px;">&infin;</span>
    @break

    @case('not_started')
        <span class="m-badge m-badge--info m-badge--wide">@lang('dashboard.not_started')</span>
    @break

    @case('over')
        <span class="m-badge m-badge--danger m-badge--wide">@lang('dashboard.over')</span>
    @break

    @default
       <span class="m-badge m-badge--success m-badge--wide">{{ $remainingDays }}</span>

@endswitch
