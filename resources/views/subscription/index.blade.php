@extends('layouts.master')

@section('title')
    {{ __('plans') }}
@endsection

@section('content')
<style>
    :root {
    --primary-color: {{ $settings['theme_primary_color'] ?? '#56cc99' }};
    --secondary-color: {{ $settings['theme_secondary_color'] ?? '#215679' }};
   
}
</style>
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                {{ __('manage') . ' ' . __('subscription') }}
            </h3>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        @if ($upcoming_package)
                            <h3 class="card-title text-danger">{{ __('note') }} : {{ __('if_youve_already_made_payment_for_your_upcoming_plan_changes_or_updates_to_the_current_and_upcoming_plan_will_not_be_permitted') }}</h3>
                        @endif
                        
                        <div class="row pricing-table mt-4">
                            @foreach ($packages as $package)
                                <div class="col-md-6 col-xl-4 grid-margin stretch-card pricing-card">
                                    <div
                                        class="card @if ($package->highlight) border-success ribbon @else border-primary @endif  border pricing-card-body">
                                        @if ($package->is_trial != 1)
                                            @if ($package->type == 1)
                                                <span class="package-type-badge postpaid-color">{{ __('postpaid') }}</span>
                                            @else
                                                <span class="package-type-badge prepaid-color">{{ __('prepaid') }}</span>
                                            @endif
                                        @endif
                                        

                                        <div class="text-center pricing-card-head mb-2">
                                            <h3>{{ __($package->name) }}</h3>
                                            <p>{{ $package->description }}</p>
                                            <h1 class="font-weight-normal mb-2"></h1>
                                            <hr>
                                            <div class="row">
                                                @if ($package->is_trial == 1)
                                                    <div class="col-sm-12 col-md-12">
                                                        <b>{{ __('package_information') }}</b>
                                                    </div>
                                                    <div class="col-sm-12 col-md-12 mt-3 text-small">
                                                        {{ __('student_limit') }} : {{ $settings['student_limit'] }}
                                                    </div>

                                                    <div class="col-sm-12 col-md-12 mt-1 text-small">
                                                        {{ __('staff_limit') }} : {{ $settings['staff_limit'] }}
                                                    </div>
                                                @elseif($package->type == 0)
                                                    <div class="col-sm-12 col-md-12">
                                                        <b>{{ __('package_price_information') }}</b>
                                                    </div>
                                                    <div class="col-sm-12 col-md-12 mt-3 text-small">
                                                        {{ __('student_limit') }} : {{ $package->no_of_students }}
                                                    </div>

                                                    <div class="col-sm-12 col-md-12 mt-1 text-small">
                                                        {{ __('staff_limit') }} : {{ $package->no_of_staffs }}
                                                    </div>
                                                    <div class="col-sm-12 col-md-12 mt-1 text-small">
                                                        {{ $settings['currency_symbol'] }} {{ $package->charges }} : {{ __('package_amount') }}
                                                    </div>
                                                @else
                                                    <div class="col-sm-12 col-md-12">
                                                        <b>{{ __('package_price_information') }}</b>
                                                    </div>
                                                    <div class="col-sm-12 col-md-12 mt-3 text-small">
                                                        {{ __('per_student_charges') }} : {{ $settings['currency_symbol'] }} {{ $package->student_charge }}
                                                    </div>

                                                    <div class="col-sm-12 col-md-12 mt-1 text-small">
                                                        {{ __('per_staff_charges') }} : {{ $settings['currency_symbol'] }} {{ $package->staff_charge }}
                                                    </div>
                                                @endif

                                                <div class="col-sm-12 col-md-12 mt-2">
                                                    @if ($package->is_trial == 1)
                                                        {{ $settings['trial_days'] }} / {{ __('days') }}
                                                    @else
                                                        {{ $package->days }} / {{ __('days') }}
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                        <hr>

                                        <ul class="list-unstyled">
                                            @foreach ($features as $feature)
                                                @if (in_array($feature->id, $package->package_feature->pluck('feature_id')->toArray()))
                                                    <li><i class="fa fa-check check mr-2"></i>{{ __($feature->name) }}</li>
                                                @else
                                                    <li><i class="fa fa-times no-feature mr-2"></i><span
                                                            class="text-decoration-line-through">{{ __($feature->name) }}</span>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                        @if (!$upcoming_package)
                                        @if ($current_plan)
                                        @if ($package->id == $current_plan->package_id)
                                            <div class="wrapper mb-3">
                                                <a href="#" class="btn disabled @if ($package->highlight) btn-success @else btn-outline-primary @endif btn-block select-plan" data-type="{{ $package->type }}" data-id="{{ $package->id }}">{{ __('current_active_plan') }}</a>
                                            </div>

                                            {{-- Set upcoming --}}
                                            <div class="col-sm-12 col-md-12">
                                                <a href="#" class="btn disabled @if ($package->highlight) btn-outline-success @else btn-outline-primary @endif btn-block select-plan" data-type="{{ $package->type }}" data-id="{{ $package->id }}">{{ __('update_upcoming_plan') }}</a>
                                            </div>
                                        @else
                                            <div class="row">
                                                <div class="col-sm-12 col-md-12 mb-3">
                                                    {{-- Start Immediate plan --}}
                                                    <a href="#" class="btn start-immediate-plan @if ($package->highlight) btn-success @else btn-primary @endif btn-block" data-type="{{ $package->type }}" data-id="{{ $package->id }}">{{ __('update_current_plan') }}</a>
                                                </div>

                                                {{-- Set upcoming --}}
                                                <div class="col-sm-12 col-md-12">
                                                    <a href="#" class="btn @if ($package->highlight) btn-outline-success @else btn-outline-primary @endif btn-block select-plan" data-type="{{ $package->type }}" data-id="{{ $package->id }}" data-iscurrentplan="0">{{ __('update_upcoming_plan') }}</a>
                                                </div>
                                            </div>
                                        @endif
                                    @else
                                        <div class="wrapper">
                                            <a href="#" class="btn @if ($package->highlight) btn-success @else btn-outline-primary @endif btn-block select-plan" data-type="{{ $package->type }}" data-iscurrentplan="1" data-id="{{ $package->id }}">{{ __('get_start') }}</a>
                                        </div>
                                    @endif
                                        @endif
                                        
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
