/*import { createApp } from 'vue';
import Toggle from '@vueform/toggle';
//import vSelect from "vue-select";


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

        }
    },
    methods: {

    }
});
document.addEventListener('DOMContentLoaded', function () {
    if (document.getElementById("pressure_measurement_create")) {
        pressure_measurement_create.mount('#pressure_measurement_create');
    }
});*/
import { createApp } from 'vue'

createApp({
  data() {
    return {
      count: 0
    }
  }
}).mount('#app')
