<template>
    <div class="container">
        <div class="row">
            <div class="col">
                <button data-toggle="modal"
                        data-target="#purchaseStockModal" type="button" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                         class="bi bi-currency-exchange" viewBox="0 0 16 16">
                        <path
                            d="M0 5a5.002 5.002 0 0 0 4.027 4.905 6.46 6.46 0 0 1 .544-2.073C3.695 7.536 3.132 6.864 3 5.91h-.5v-.426h.466V5.05c0-.046 0-.093.004-.135H2.5v-.427h.511C3.236 3.24 4.213 2.5 5.681 2.5c.316 0 .59.031.819.085v.733a3.46 3.46 0 0 0-.815-.082c-.919 0-1.538.466-1.734 1.252h1.917v.427h-1.98c-.003.046-.003.097-.003.147v.422h1.983v.427H3.93c.118.602.468 1.03 1.005 1.229a6.5 6.5 0 0 1 4.97-3.113A5.002 5.002 0 0 0 0 5zm16 5.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0zm-7.75 1.322c.069.835.746 1.485 1.964 1.562V14h.54v-.62c1.259-.086 1.996-.74 1.996-1.69 0-.865-.563-1.31-1.57-1.54l-.426-.1V8.374c.54.06.884.347.966.745h.948c-.07-.804-.779-1.433-1.914-1.502V7h-.54v.629c-1.076.103-1.808.732-1.808 1.622 0 .787.544 1.288 1.45 1.493l.358.085v1.78c-.554-.08-.92-.376-1.003-.787H8.25zm1.96-1.895c-.532-.12-.82-.364-.82-.732 0-.41.311-.719.824-.809v1.54h-.005zm.622 1.044c.645.145.943.38.943.796 0 .474-.37.8-1.02.86v-1.674l.077.018z"/>
                    </svg>
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h4>List all clients</h4>
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" data-toggle="modal"
                     data-target="#addClientModal" style="cursor: pointer" fill="currentColor"
                     class="bi bi-person-plus text-success" viewBox="0 0 16 16">
                    <path
                        d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                    <path fill-rule="evenodd"
                          d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                </svg>
                <Client v-if="reRenderClient&reRenderStock"/>
            </div>
            <div class="col">
                <h4>List all stocks</h4>
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                     style="cursor: pointer" data-toggle="modal"
                     data-target="#addStockModal" fill="currentColor" class="bi bi-plus text-success"
                     viewBox="0 0 16 16">
                    <path
                        d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                </svg>
                <Stock @clicked="onClickStockChild" v-if="reRenderClient&reRenderStock"/>
            </div>
        </div>
    </div>
    <Modal  @clicked="onClickChild"/>
    <StockModal  @clicked="onClickStockChild"/>
    <PurchaseStockModel :render-client="reRenderClient" :render-stock="reRenderStock"  @clicked="onClickChild"/>
</template>
<script>
import axios from 'axios';
import Modal from "../components/AddClientModal.vue";
import StockModal from "../components/AddStockModal.vue";
import Client from "../components/Client.vue";
import Stock from "../components/Stock.vue";
import PurchaseStockModel from "../components/PurchaseStockModel.vue";

export default {
    name: "HomeView",
    components: {
        'PurchaseStockModel': PurchaseStockModel,
        'Modal': Modal,
        'StockModal': StockModal,
        'Client': Client,
        'Stock': Stock
    },
    data() {
        return {
            reRenderClient: true,
            reRenderStock: true,
            reRenderPurchase: true,
        }
    },
    mounted() {
    },

    methods: {
        successAlertDisplay(text) {
            this.$swal({
                icon: 'success',
                title: 'Message',
                text: text,
                confirmButtonColor: '#3085d6',
            });
        },
        onClickChild(value) {
            this.successAlertDisplay(value);
            this.reRenderClient = false;
            this.$nextTick(() => {
                this.reRenderClient = true;
            });
        },
        onClickStockChild(value) {
            this.successAlertDisplay(value);
            this.reRenderStock = false;
            this.$nextTick(() => {
                this.reRenderStock = true;
            });
        },
    }
}
</script>
<style>
.row {
    padding-top: 20px;
}
</style>
