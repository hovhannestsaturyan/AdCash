<template>
    <div class="modal fade" id="updateStockModal" tabindex="-1" role="dialog" aria-labelledby="updateStockModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateStockModalLabel">Update existing stock</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <select name="stock" v-model="stock" class="form-control">
                            <option value="">Choose Stock</option>
                            <option v-for="(item) in stocks" :value="item.id">{{ item.name }}</option>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">€</span>
                        </div>
                        <input type="text" v-model="unit_price" class="form-control" placeholder="Unit Price"
                               aria-label="Unit Price" aria-describedby="unit_price">
                    </div>
                    <p class="text-danger" v-if="errorMessage">{{ errorMessage }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="close_update_stock" data-dismiss="modal">Cancel
                    </button>
                    <button @click="updateStock" type="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: "UpdateStockModel",
    props: {
        stock: Number,
    },
    data() {
        return {
            stocks: '',
            unit_price: '',
            errorMessage: '',
        }
    },
    mounted() {
        this.getStocks();
    },
    methods: {
        updateStock() {
            this.errorMessage = '';
            axios.put(import.meta.env.VITE_BASE_URL + '/api/stocks/' + this.stock + '?unit_price=' + this.unit_price)
                .then(response => {
                    this.$emit('clicked', response.data);
                    this.unit_price = '';
                    this.errorMessage = '';
                    this.getStocks();
                    document.getElementById('close_update_stock').click();
                }).catch(error => {
                this.errorMessage = error.response.data.message
            });
        },
        getStocks() {
            axios.get(import.meta.env.VITE_BASE_URL + '/api/stocks?all=true')
                .then(response => {
                    this.stocks = response.data.data
                }).catch(error => {
            });
        },
    }
}
</script>

<style scoped>

</style>
