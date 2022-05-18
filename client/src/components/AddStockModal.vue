<template>
    <div class="modal fade" id="addStockModal" tabindex="-1" role="dialog" aria-labelledby="addStockModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addStockModalLabel">Create a new stock</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <input type="text" v-model="company_name" class="form-control" placeholder="Company Name"
                        >
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">€</span>
                        </div>
                        <input type="text" v-model="unit_price" class="form-control" placeholder="Unit Price"
                               aria-label="Unit Price" aria-describedby="unit_price">
                    </div>
                    <p class="text-danger" v-for="(error_msg) in errorMessage">{{ error_msg[0] }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="close_add_stock" data-dismiss="modal">Cancel
                    </button>
                    <button @click="addStock" type="button" class="btn btn-primary">Add</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: "addStockModal",
    props: {},
    data() {
        return {
            unit_price: '',
            company_name: '',
            errorMessage: '',
        }
    },

    methods: {
        addStock() {
            this.errorMessage = '';
            let data = {name: this.company_name, unit_price: this.unit_price};
            axios.post(import.meta.env.VITE_BASE_URL + '/api/stocks', data)
                .then(response => {
                    this.$emit('clicked', response.data);
                    this.unit_price = ''
                    this.company_name = ''
                    this.errorMessage = ''
                    document.getElementById('close_add_stock').click();
                }).catch(error => {
                this.errorMessage = error.response.data.errors

            });
        },
    }
}
</script>

<style scoped>

</style>
