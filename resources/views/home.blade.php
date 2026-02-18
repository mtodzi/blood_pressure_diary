@extends('layouts.app')

@section('content')
<div id = "home">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Your blood pressure measurements') }}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="table-success" rowspan="2" scope="col">{{ __('measurement ID') }}</th>
                                        <th class="table-success" rowspan="2" scope="col">{{ __('date') }}</th>
                                        <th class="table-info" scope="col">{{ __('left systolic') }}</th>
                                        <th class="table-info" scope="col">{{ __('left diastolic') }}</th>
                                        <th class="table-info" scope="col">{{ __('left pulse') }}</th>
                                        <th class="table-success" rowspan="2" scope="col">{{ __('action') }}</th>
                                    </tr>
                                    <tr>
                                        <th class="table-light" scope="col">{{ __('right systolic') }}</th>
                                        <th class="table-light" scope="col">{{ __('right diastolic') }}</th>
                                        <th class="table-light" scope="col">{{ __('right pulse') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template v-for="(measurement, index) in data_table" :key="index">
                                        <tr>
                                            <td  style="text-align: center;" class="bg-success" rowspan="2" scope="col">@{{measurement.id}}</td>
                                            <td  style="text-align: center;" class="bg-success" rowspan="2" scope="col">@{{measurement.created_at}}</td>
                                            <td  style="text-align: center;" class="bg-info" scope="col">@{{measurement.systolic_middle_left}}</td>
                                            <td  style="text-align: center;" class="bg-info" scope="col">@{{measurement.diastolic_middle_left}}</td>
                                            <td  style="text-align: center;" class="bg-info" scope="col">@{{measurement.pulse_middle_left}}</td>
                                            <td  style="text-align: center;" class="bg-success" rowspan="2" scope="col">
                                                <button class="btn btn-primary" type="button" v-on:click.prevent="show(index)">
                                                    {{ __('Show') }}
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td  style="text-align: center;" class="bg-light" scope="col">@{{measurement.systolic_middle_right}}</td>
                                            <td  style="text-align: center;" class="bg-light" scope="col">@{{measurement.diastolic_middle_right}}</td>
                                            <td  style="text-align: center;" class="bg-light" scope="col">@{{measurement.pulse_middle_right}}</td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button v-if = "is_bt_back" v-on:click.prevent="back" type="button" class="btn btn-primary">{{ __('Back') }}</button>
                        <button v-if = "is_bt_forward" v-on:click.prevent="forward" type="button" class="btn btn-primary">{{__("Forward")}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <h6>{{ __('Measurements of the left hand') }}</h6>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="table-info" scope="col">{{ __('Systolic') }}</th>
                        <th class="table-info" scope="col">{{ __('Diastolic') }}</th>
                        <th class="table-info" scope="col">{{ __('Pulse') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <template v-for="(left_measurement, index) in left_show" :key="index">
                        <tr>
                            <td  style="text-align: center;" class="bg-info" scope="col">@{{left_measurement.systolic}}</td>
                            <td  style="text-align: center;" class="bg-info" scope="col">@{{left_measurement.diastolic}}</td>
                            <td  style="text-align: center;" class="bg-info" scope="col">@{{left_measurement.pulse}}</td>
                        </tr>
                    </template>
                </tbody>
            </table>
            <h6>{{ __('Measurements of the right hand') }}</h6>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="table-info" scope="col">{{ __('Systolic') }}</th>
                        <th class="table-info" scope="col">{{ __('Diastolic') }}</th>
                        <th class="table-info" scope="col">{{ __('Pulse') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <template v-for="(right_measurement, index) in right_show" :key="index">
                        <tr>
                            <td  style="text-align: center;" class="bg-info" scope="col">@{{right_measurement.systolic}}</td>
                            <td  style="text-align: center;" class="bg-info" scope="col">@{{right_measurement.diastolic}}</td>
                            <td  style="text-align: center;" class="bg-info" scope="col">@{{right_measurement.pulse}}</td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
