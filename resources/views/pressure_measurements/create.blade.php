@extends('layouts.app')

@section('content')
<div class="container" id="pressure_measurement_create">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title d-inline">{{ __('Left hand') }}</h5>
                    <a href="{{route('home')}}" type="button" class="btn btn-dark btn-sm mx-2 float-end">{{ __('Back') }}</a>
                    <div class="float-end"><toggle @change="toggle_left_change"  class="mb-3" v-model="is_left_hend" :disabled = "toggle_left_disabled"/></div>
                </div>
                <div v-if="is_left_hend" class="card-body">
                    <div v-for="(measurement, index) in left_measurements" :key="index" class="row mb-3">
                        <div class="col">
                            <label :for="'left_systolic_' + (index + 1)" class="form-label">{{ __('Systolic') }} @{{ index + 1 }}</label>
                            <input type="number" class="form-control" :id="'left_systolic_' + (index + 1)" v-model="measurement.systolic" :disabled="measurement.disabled">
                            <div v-if="measurement.errors.systolic" class="text-danger">
                                @{{ measurement.errors.systolic }}
                            </div>
                        </div>
                        <div class="col">
                            <label :for="'left_diastolic_' + (index + 1)" class="form-label">{{ __('Diastolic') }} @{{ index + 1 }}</label>
                            <input type="number" class="form-control" :id="'left_diastolic_' + (index + 1)" v-model="measurement.diastolic" :disabled="measurement.disabled">
                            <div v-if="measurement.errors.diastolic" class="text-danger">
                                @{{ measurement.errors.diastolic }}
                            </div>
                        </div>
                        <div class="col">
                            <label :for="'left_pulse_' + (index + 1)" class="form-label">{{ __('Pulse') }} @{{ index + 1 }}</label>
                            <input type="number" class="form-control" :id="'left_pulse_' + (index + 1)" v-model="measurement.pulse" :disabled="measurement.disabled">
                            <div v-if="measurement.errors.pulse" class="text-danger">
                                @{{ measurement.errors.pulse }}
                            </div>
                        </div>
                        <div class="col-auto d-flex align-items-end">
                            <button type="button" class="btn btn-sm btn-primary" @click="enableNextMeasurement('left', index)" :disabled="measurement.disabled">{{ __('Apply') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="my-1 row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title d-inline">{{ __('Right hand') }}</h5>
                    <a href="{{route('home')}}" type="button" class="btn btn-dark btn-sm mx-2 float-end">{{ __('Back') }}</a>
                    <div class="float-end"><toggle @change="toggle_right_change" class="mb-3" v-model="is_right_hend" :disabled = "toggle_right_disabled" /></div>
                </div>
                <div v-if="is_right_hend" class="card-body">
                    <div v-for="(measurement, index) in right_measurements" :key="index" class="row mb-3">
                        <div class="col">
                            <label :for="'right_systolic_' + (index + 1)" class="form-label">{{ __('Systolic') }} @{{ index + 1 }}</label>
                            <input type="number" class="form-control" :id="'right_systolic_' + (index + 1)" v-model="measurement.systolic" :disabled="measurement.disabled">
                            <div v-if="measurement.errors.systolic" class="text-danger">
                                @{{ measurement.errors.systolic }}
                            </div>
                        </div>
                        <div class="col">
                            <label :for="'right_diastolic_' + (index + 1)" class="form-label">{{ __('Diastolic') }} @{{ index + 1 }}</label>
                            <input type="number" class="form-control" :id="'right_diastolic_' + (index + 1)" v-model="measurement.diastolic" :disabled="measurement.disabled">
                            <div v-if="measurement.errors.diastolic" class="text-danger">
                                @{{ measurement.errors.diastolic }}
                            </div>
                        </div>
                        <div class="col">
                            <label :for="'right_pulse_' + (index + 1)" class="form-label">{{ __('Pulse') }} @{{ index + 1 }}</label>
                            <input type="number" class="form-control" :id="'right_pulse_' + (index + 1)" v-model="measurement.pulse" :disabled="measurement.disabled">
                            <div v-if="measurement.errors.pulse" class="text-danger">
                                @{{ measurement.errors.pulse }}
                            </div>
                        </div>
                        <div class="col-auto d-flex align-items-end">
                            <button type="button" class="btn btn-sm btn-primary" @click="enableNextMeasurement('right', index)" :disabled="measurement.disabled">{{ __('Apply') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="my-1 row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <button v-if="is_save" type="button" class="btn btn-sm btn-primary" @click="save_measurements">{{ __('Save') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
