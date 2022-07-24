@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Traceability System</h1>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Traceability System</h6>
            </div>
            <div class="card-body">
                <div class="container">
                    <div class="row text-center justify-content-center mb-5">
                        <div class="col-xl-6 col-lg-8">
                            <h2 class="font-weight-bold">Traceability System</h2>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="timeline-steps aos-init aos-animate" data-aos="fade-up">
                                <div class="timeline-step">
                                    <div class="timeline-content" data-toggle="popover" data-trigger="hover"
                                        data-placement="top" title=""
                                        data-content="And here's some amazing content. It's very engaging. Right?"
                                        data-original-title="2003">
                                        <div class="inner-circle"></div>
                                        <p class="h4 mt-3 mb-1">{{ $trace->user->name }}</p>
                                        <p class="h6 mb-1">{{ $trace->user->role }}</p>
                                        <p class="h6 text-muted mb-0 mb-lg-0">{{ Helper::waktu($trace->created_at) }}</p>
                                    </div>
                                </div>
                                @foreach ($trace->detail as $detail)
                                    <div class="timeline-step">
                                        <div class="timeline-content" data-toggle="popover" data-trigger="hover"
                                            data-placement="top" title=""
                                            data-content="And here's some amazing content. It's very engaging. Right?"
                                            data-original-title="2003">
                                            <div class="inner-circle"></div>
                                            <p class="h4 mt-3 mb-1">{{ $detail->user->name }}</p>
                                            <p class="h6 mb-1">{{ $detail->user->role }}</p>
                                            <p class="h6 text-muted mb-0 mb-lg-0">{{ Helper::waktu($detail->created_at) }}
                                            </p>
                                        </div>
                                    </div>
                                    @foreach ($detail->item as $item)
                                        <div class="timeline-step">
                                            <div class="timeline-content" data-toggle="popover" data-trigger="hover"
                                                data-placement="top" title=""
                                                data-content="And here's some amazing content. It's very engaging. Right?"
                                                data-original-title="2003">
                                                <div class="inner-circle"></div>
                                                <p class="h4 mt-3 mb-1">{{ $item->user->name }}</p>
                                                <p class="h6 mb-1">{{ $item->user->role }}</p>
                                                <p class="h6 text-muted mb-0 mb-lg-0">{{ Helper::waktu($item->created_at) }}
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .timeline-steps {
            display: flex;
            justify-content: center;
            flex-wrap: wrap
        }

        .timeline-steps .timeline-step {
            align-items: center;
            display: flex;
            flex-direction: column;
            position: relative;
            margin: 1rem
        }

        @media (min-width:768px) {
            .timeline-steps .timeline-step:not(:last-child):after {
                content: "";
                display: block;
                border-top: .25rem dotted #3b82f6;
                width: 3.46rem;
                position: absolute;
                left: 7.5rem;
                top: .3125rem
            }

            .timeline-steps .timeline-step:not(:first-child):before {
                content: "";
                display: block;
                border-top: .25rem dotted #3b82f6;
                width: 3.8125rem;
                position: absolute;
                right: 7.5rem;
                top: .3125rem
            }
        }

        .timeline-steps .timeline-content {
            width: 10rem;
            text-align: center
        }

        .timeline-steps .timeline-content .inner-circle {
            border-radius: 1.5rem;
            height: 1rem;
            width: 1rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background-color: #3b82f6
        }

        .timeline-steps .timeline-content .inner-circle:before {
            content: "";
            background-color: #3b82f6;
            display: inline-block;
            height: 3rem;
            width: 3rem;
            min-width: 3rem;
            border-radius: 6.25rem;
            opacity: .5
        }
    </style>
@endpush
