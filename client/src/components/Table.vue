<template>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th scope="col" v-for="(item) in header">{{item}}</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(item, index) in clientData.data">
            <td>{{ item.name }}</td>
            <td>{{ item.cash_balance }}</td>
            <td v-bind:class="[gain_loss(item.purchases)<0 ? 'text-danger' : gain_loss(item.purchases)>0 ? 'text-success' : '' , errorClass]"><span v-if="gain_loss(item.purchases)>0"> + </span>{{item.currency + ' ' + gain_loss(item.purchases) }}</td>
            <td>
                <div class="dropdown text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-dots-fill dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false" viewBox="0 0 16 16">
                        <path d="M16 8c0 3.866-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.584.296-1.925.864-4.181 1.234-.2.032-.352-.176-.273-.362.354-.836.674-1.95.77-2.966C.744 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7zM5 8a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm4 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                    </svg>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">Action</a>
                    </div>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
    <Pagination :data="clientData" @pagination-change-page="getResults"/>
</template>

<script>
export default {
    name: "Table"
}
</script>

<style scoped>

</style>
