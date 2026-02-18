import { createApp } from 'vue';
import { Offcanvas } from 'bootstrap';


const home = createApp({
    mounted() {
        console.log("mounted");
        this.get_data_table();
        this.offcanvas = new Offcanvas(document.getElementById("offcanvasExample"));
    },
    components: {
    },
    data() {
        return {
            data_table: [],
            is_bt_back: false,
            is_bt_forward: true,
            next_page_url: null,
            prev_page_url: null,
            offcanvas: null,
            left_show: [],
            right_show: []
        }
    },
    computed: {
    },
    methods: {
        show: function(index){
            this.left_show = this.data_table[index].left_measurements;
            this.right_show = this.data_table[index].right_measurements;
            this.offcanvas.show();
        },
        hide: function(){
            this.offcanvas.hide();
        },
        back: function(){
            this.get_data_table(this.prev_page_url);
        },
        forward: function(){
            this.get_data_table(this.next_page_url);
        },
        get_data_table: function(next_page_url = null){
            const data = {per_page : 35, next_page_url: next_page_url};
            fetch('/pressure-measurements/data-table', {
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
                this.data_table = data.measurements.data;
                console.log( this.prev_page_url, this.next_page_url);
                this.prev_page_url = data.measurements.prev_cursor;
                this.next_page_url = data.measurements.next_cursor;
                if(this.prev_page_url !== null){
                    this.is_bt_back = true;
                }else{
                    this.is_bt_back = false;
                }
                if(this.next_page_url !== null){
                    this.is_bt_forward = true;
                }else{
                    this.is_bt_forward = false;
                }
                console.log( this.prev_page_url, this.next_page_url);
            })
            .catch((error) => {
                console.error('Error:', error);
            });
        }
    }
});
document.addEventListener('DOMContentLoaded', function () {
    if (document.getElementById("home")) {
        home.mount('#home');
    }
});
