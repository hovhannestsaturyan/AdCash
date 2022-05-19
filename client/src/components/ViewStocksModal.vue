<template>
    <div class="modal fade" id="viewStockModal" tabindex="-1" role="dialog" aria-labelledby="viewStockModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewStockModalLabel">List client's stocks <span
                        class="client text-secondary">{{ clientName }}</span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col" v-for="(item) in header">{{ item }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(item, index) in sortedProperties">
                            <td>{{ item.name }}</td>
                            <td>{{ item?.pivot.value }}</td>
                            <td>{{ item?.pivot.purchase_price }}</td>
                            <td>{{ item.unit_price }}</td>
                            <td v-bind:class="[item.gain_loss<0 ? 'text-danger' : item.gain_loss>0 ? 'text-success' : '']">
                                <span v-if="item.gain_loss>0"> + </span>{{
                                    stocks.currency + ' ' + item.gain_loss
                                }}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="client text-right">
                        <p v-bind:class="[total<0 ? 'text-danger' : total>0 ? 'text-success' : '']">Total <span
                            v-if="total>0"> + </span> {{ currency }} {{ total }}</p>
                        <p>Invested {{ currency }} {{ invested }}</p>
                        <p v-bind:class="[performance<0 ? 'text-danger' : performance>0 ? 'text-success' : '']">
                            Performance <span v-if="performance>0"> + </span> {{ performance.toFixed(2) }}%</p>
                        <p>Cash Balance {{ currency }} {{ cash_balance }}</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: "ViewStockModal",
    props: {
        clientName: String,
        clientId: Number
    },
    data() {
        return {
            header: [
                'Company',
                'Volume',
                'Purchase price',
                'Volume price',
                'Gain/Loss',
            ],
            stocks: '',
            sortedProperties: {},
            errorMessage: '',
            currency: '',
            total: 0,
            invested: 0,
            performance: 0,
            cash_balance: 0,
            sortDirection: 0,
            sortBy: 'gain_loss',
        }
    },
    mounted() {
    },
    watch: {
        clientId(newQuestion, oldQuestion) {
            this.total = 0;
            this.invested = 0;
            this.performance = 0;
            this.cash_balance = 0;
            this.viewStocks();
        }
    },
    methods: {
        sort(head) {
            this.sortBy = head
            this.sortDirection *= -1
        },
        sortProps() {
            const direction = this.sortDirection
            const head = this.sortBy
            this.sortedProperties = this.stocks?.purchases.sort(this.sortMethods(head, direction))
        },
        sortMethods(head, direction) {
                    return direction === 1 ?
                        (a, b) => Number(a[head]) - Number(b[head]):
                        (a, b) => Number(b[head]) - Number(a[head])

        },
        gain_loss(purchases) {
            purchases.gain_loss = purchases?.pivot.value * (Number(purchases.unit_price) - Number(purchases?.pivot.purchase_price));
        },
        details() {
            const that = this;
            this.stocks?.purchases.map(function (purchases, key) {
                that.invested += purchases?.pivot?.value * Number(purchases?.pivot?.purchase_price);
                that.total += purchases?.pivot?.value * (Number(purchases?.unit_price) - Number(purchases?.pivot?.purchase_price));
                if (that.total + that.invested <= 0) {
                    that.performance = -100;
                } else {
                    that.performance = (that.total / that.invested) * 100;
                }
            });
        },

         async  viewStocks() {
            const that = this;
            this.errorMessage = '';
            let data = {stock_id: this.stock, client_id: this.client, value: this.stock_value};
            axios.get(import.meta.env.VITE_BASE_URL + '/api/clients/get-purchases/' + this.clientId, data)
                .then(async response => {
                    this.cash_balance = response.data.cash_balance;
                    this.currency = response.data.currency;
                  response?.data?.purchases.map(function (item, key) {
                        that.gain_loss(item)
                    });
                    this.stocks = await response.data;
                  await  this.sortProps();
                  await  this.details();
                }).catch(error => {
                this.errorMessage = error.response.data.message;
            });
        },
    }
}
</script>

<style scoped>
.client {
    font-size: 15px;
}
</style>
