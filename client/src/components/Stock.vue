<template>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th scope="col" v-for="(item) in header">{{ item }}</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(item, index) in stocksData.data">
            <td>{{ item.name }}</td>
            <td>{{ item.unit_price }}</td>
            <td>{{ item.updated_at }}</td>
            <td>
                <div class="dropdown text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                         class="bi bi-chat-dots-fill dropdown-toggle" type="button" id="dropdownMenuButton"
                         data-toggle="dropdown" aria-expanded="false" viewBox="0 0 16 16">
                        <path
                            d="M16 8c0 3.866-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.584.296-1.925.864-4.181 1.234-.2.032-.352-.176-.273-.362.354-.836.674-1.95.77-2.966C.744 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7zM5 8a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm4 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                    </svg>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" @click="getStockID(item.id)" href="#" data-toggle="modal"
                           data-target="#updateStockModal">Update unit price</a>
                        <a class="dropdown-item" @click="alertToDelete(item.id,item.name)" href="#">Delete stock</a>
                    </div>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
    <Pagination :data="stocksData" @pagination-change-page="getStocksResult"/>
    <UpdateStockModal @clicked="onClickUpdateStockChild" :stock="stockID" />
</template>

<script>
import axios from 'axios';
import LaravelVuePagination from 'laravel-vue-pagination';
import UpdateStockModal from "./UpdateStockModal.vue";
export default {
    name: "Stock",
    components: {
        'Pagination': LaravelVuePagination,
        'UpdateStockModal': UpdateStockModal,
    },
    props: {
        modalDetails: Object
    },
    data() {
        return {
            stocksData: {},
            header: [
                'Company',
                'Unit Price',
                'Updated at',
                'Actions',
            ],
            total_unit_price: 0,
            total_purchase_price: 0,
            stockID: Number,
        }
    },
    mounted() {
        this.getStocksResult();
    },
    methods: {
        onClickUpdateStockChild(value) {
            this.successAlertDisplay(value);
            this.$emit('clicked', 'Done');

        },
        successAlertDisplay(text) {
            this.$swal({
                icon: 'success',
                title: 'Message',
                text: text,
                confirmButtonColor: '#3085d6',
            });
        },
        getStockID(id){
            this.stockID = id;
        },
        alertToDelete(id, name) {
            this.$swal({
                icon: 'warning',
                title: 'Are you sure you want to delete '+name+' ?',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
            }).then((result) => {
                if (result.isConfirmed) {
                  this.deleteStock(id);
                }
            });
        },
        getStocksResult(page = 1) {
            axios.get(import.meta.env.VITE_BASE_URL + '/api/stocks?page=' + page)
                .then(response => {
                    this.stocksData = response.data;
                });
        },
        deleteStock(id){
            let data = {id: id};
            axios.delete(import.meta.env.VITE_BASE_URL + '/api/stocks/'+id)
                .then(response => {
                    this.$swal(
                        'Deleted!',
                        response.data,
                        'success'
                    )
                    this.$emit('clicked', response.data)
                  //  document.getElementById('close').click();
                }).catch(error => {
              //  this.errorMessage = error.response.data.message

            });
        }
    }
}
</script>

<style scoped>

</style>
