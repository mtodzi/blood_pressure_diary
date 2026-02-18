import { createApp } from 'vue';
import Toggle from '@vueform/toggle';



const pressure_measurement_create = createApp({
    mounted() {
        console.log("mounted");
    },
    components: {
        toggle: Toggle,
        //v_select: vSelect
    },
    data() {
        return {
            is_left_hend: true,
            toggle_right_disabled: false,
            toggle_left_disabled: false,
            is_right_hend: true,
            left_measurements: [
                { systolic: null, diastolic: null, pulse: null, disabled: false, filled: false, errors: { systolic: '', diastolic: '', pulse: '' } },
                { systolic: null, diastolic: null, pulse: null, disabled: true, filled: false, errors: { systolic: '', diastolic: '', pulse: '' } },
                { systolic: null, diastolic: null, pulse: null, disabled: true, filled: false, errors: { systolic: '', diastolic: '', pulse: '' } },
            ],
            right_measurements: [
                { systolic: null, diastolic: null, pulse: null, disabled: false, filled: false, errors: { systolic: '', diastolic: '', pulse: '' } },
                { systolic: null, diastolic: null, pulse: null, disabled: true, filled: false, errors: { systolic: '', diastolic: '', pulse: '' } },
                { systolic: null, diastolic: null, pulse: null, disabled: true, filled: false, errors: { systolic: '', diastolic: '', pulse: '' } },
            ],
            is_save: false
        }
    },
    computed: {
    },
    methods: {
        save_measurements: function() {
            const data = {
                left_measurements: this.left_measurements.filter(m => m.filled),
                right_measurements: this.right_measurements.filter(m => m.filled),
                is_left_hend: this.is_left_hend,
                is_right_hend: this.is_right_hend
            };

            fetch('/pressure-measurements', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(data)
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log('Success:', data);
                window.location.href = '/home';
            })
            .catch((error) => {
                console.error('Error:', error);
            });
        },
        validateMeasurement: function(measurement) {
            let isValid = true;
            measurement.errors = { systolic: '', diastolic: '', pulse: '' }; // Reset errors

            if (measurement.systolic === null || String(measurement.systolic).trim() === '') {
                measurement.errors.systolic = 'Поле систолическое обязательно для заполнения.';
                isValid = false;
            } else if (isNaN(measurement.systolic)) {
                measurement.errors.systolic = 'Поле систолическое должно быть числом.';
                isValid = false;
            }

            if (measurement.diastolic === null || String(measurement.diastolic).trim() === '') {
                measurement.errors.diastolic = 'Поле диастолическое обязательно для заполнения.';
                isValid = false;
            } else if (isNaN(measurement.diastolic)) {
                measurement.errors.diastolic = 'Поле диастолическое должно быть числом.';
                isValid = false;
            }

            if (measurement.pulse === null || String(measurement.pulse).trim() === '') {
                measurement.errors.pulse = 'Поле пульс обязательно для заполнения.';
                isValid = false;
            } else if (isNaN(measurement.pulse)) {
                measurement.errors.pulse = 'Поле пульс должно быть числом.';
                isValid = false;
            }

            return isValid;
        },
        enableNextMeasurement: function(side, index){
            const measurements = side === 'left' ? this.left_measurements : this.right_measurements;
            const currentMeasurement = measurements[index];

            if (this.validateMeasurement(currentMeasurement)) {
                measurements[index].filled = true;
                if (index + 1 < measurements.length) {
                    measurements[index + 1].disabled = false;
                }
                if(index - 1 <= 0){
                     measurements[index].disabled = true;
                }
                if(index === 2){
                    measurements[index].disabled = true;
                    if(side === 'left' && !this.is_right_hend){
                        this.is_save = true;
                        this.toggle_right_disabled = true;
                    }else if(side === 'right' && !this.is_left_hend){
                        this.is_save = true;
                        this.toggle_left_disabled = true;
                    }else if(side === 'left' && this.right_measurements[2].filled){
                        this.is_save = true;
                    }else if(side === 'right' && this.left_measurements[2].filled){
                        this.is_save = true;
                    }

                }
            }
        },
        toggle_right_change: function() {
            if(this.left_measurements[2].filled && this.is_right_hend === false){
                this.is_save = true;
                this.toggle_right_disabled = true;
            }
        },
        toggle_left_change: function() {
            if(this.right_measurements[2].filled && this.is_left_hend === false){
                this.is_save = true;
                this.toggle_left_disabled = true;
            }
        }

    }
});
document.addEventListener('DOMContentLoaded', function () {
    if (document.getElementById("pressure_measurement_create")) {
        pressure_measurement_create.mount('#pressure_measurement_create');
    }
});
