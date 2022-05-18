<template>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th scope="col" v-for="(item) in header">{{ item }}</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(item, index) in clientData.data">
            <td>{{ item.name }}</td>
            <td>{{ item.cash_balance }}</td>
            <td v-bind:class="[gain_loss(item.purchases)<0 ? 'text-danger' : gain_loss(item.purchases)>0 ? 'text-success' : '']">
                <span v-if="gain_loss(item.purchases)>0"> + </span>{{
                    item.currency + ' ' + gain_loss(item.purchases)
                }}
            </td>
            <td>
                <div class="dropdown text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                         class="bi bi-chat-dots-fill dropdown-toggle" type="button" id="dropdownMenuButton"
                         data-toggle="dropdown" aria-expanded="false" viewBox="0 0 16 16">
                        <path
                            d="M16 8c0 3.866-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.584.296-1.925.864-4.181 1.234-.2.032-.352-.176-.273-.362.354-.836.674-1.95.77-2.966C.744 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7zM5 8a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm4 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                    </svg>
                    <div class="dropdown-menu" @click="getClientDetails(item.id,item.name)"
                         aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" data-toggle="modal"
                           data-target="#viewStockModal" href="#">View
                            stocks</a>
                    </div>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
    <Pagination :data="clientData" @pagination-change-page="getResults"/>
    <ViewStocksModal @clicked="onClickViewStockChild" :client-name="clientName" :client-id="clientID"/>

</template>

<script>

import LaravelVuePagination from 'laravel-vue-pagination';
import axios from 'axios';
import ViewStocksModal from "./ViewStocksModal.vue";

export default {
    name: "Client",
    components: {
        'Pagination': LaravelVuePagination,
        'ViewStocksModal': ViewStocksModal,
    },
    props: {
        modalDetails: Object
    },
    data() {
        return {
            clientData: {},
            header: [
                'Client',
                'Cash Balance',
                'Gain/Loss',
                'Actions',
            ],
            total_unit_price: 0,
            total_purchase_price: 0,
            clientName: String,
            clientID: Number
        }
    },
    mounted() {
        this.getResults();
    },
    methods: {
        getClientDetails(id, name) {
            this.clientName = name;
            this.clientID = id;
        },
        onClickViewStockChild(value) {
            this.successAlertDisplay(value);
            this.$emit('clicked', 'clicked');

        },
        successAlertDisplay(text) {
            this.$swal({
                icon: 'success',
                title: 'Message',
                text: text,
                confirmButtonColor: '#3085d6',
            });
        },
        gain_loss(purchases) {
            let total_unit_price = 0
            let total_purchase_price = 0
            purchases.map(function (value, key) {
                total_unit_price += value?.pivot?.value * Number(value.unit_price)
                total_purchase_price += value?.pivot?.value *  Number(value?.pivot?.purchase_price)
            });
            return (total_unit_price - total_purchase_price);

        },
        getResults(page = 1) {
            axios.get(import.meta.env.VITE_BASE_URL + '/api/clients?page=' + page)
                .then(response => {
                    this.clientData = response.data;
                });
        },
    }
}
</script>

<style scoped>

</style>
