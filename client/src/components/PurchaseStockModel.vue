<template>
    <div class="modal fade" id="purchaseStockModal" tabindex="-1" role="dialog"
         aria-labelledby="purchaseStockModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="purchaseStockModalLabel">Purchase a stock</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <select name="client" v-model="client" class="form-control">
                            <option value="">Choose Client</option>
                            <option v-for="(item) in clients" :value="item.id">{{ item.name }}</option>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <select name="stock" v-model="stock" class="form-control">
                            <option value="">Choose Stock</option>
                            <option v-for="(item) in stocks" :value="item.id">{{ item.name }}</option>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" v-model="stock_value" class="form-control" placeholder="Volume"
                        >
                    </div>
                    <p class="text-danger" v-for="(error_msg) in errorMessage">{{ error_msg[0] }}</p>
                    <p class="text-danger" v-if="paymentError">{{ paymentError }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="close_purchase_stock" data-dismiss="modal">
                        Cancel
                    </button>
                    <button @click="purchaseStock" type="button" class="btn btn-primary">Add</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: "PurchaseStockModel",
    props: {
        renderClient: Boolean,
        renderStock: Boolean,

    },
    data() {
        return {
            clients: '',
            stocks: '',
            client: '',
            stock: '',
            stock_value: '',
            errorMessage: '',
            paymentError: '',
        }
    },
    mounted() {
        this.getClients();
        this.getStocks();
    },
    watch: {
        renderClient(newQuestion, oldQuestion) {
            this.getClients();
        },
        renderStock(newQuestion, oldQuestion) {
            this.getStocks();
        },
    },
    methods: {
        purchaseStock() {
            this.errorMessage = '';
            this.paymentError = '';
            let data = {stock_id: this.stock, client_id: this.client, value: this.stock_value};
            axios.post(import.meta.env.VITE_BASE_URL + '/api/purchase-stock', data)
                .then(response => {
                    this.$emit('clicked', response.data);
                    this.getClients(),
                        this.getStocks(),
                        this.client = '',
                        this.stock = '',
                        this.stock_value = '',
                        this.errorMessage = '',
                        this.paymentError = '',
                        document.getElementById('close_purchase_stock').click();
                }).catch(error => {
                if (error.response.status == 422) {
                    this.errorMessage = error.response.data.errors
                } else if (error.response.status == 402) {
                    this.paymentError = error.response.data.message
                }
            });
        },
        getClients() {
            axios.get(import.meta.env.VITE_BASE_URL + '/api/clients?all=true')
                .then(response => {
                    this.clients = response.data.data
                }).catch(error => {
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
