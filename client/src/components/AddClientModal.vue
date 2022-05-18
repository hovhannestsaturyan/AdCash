<template>
    <div class="modal fade" id="addClientModal" tabindex="-1" role="dialog" aria-labelledby="addClientModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addClientModalLabel">Create a new client</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input type="text" v-model="username" class="form-control" placeholder="Username"
                               aria-label="Username" aria-describedby="username">
                    </div>
                    <p class="text-danger" v-if="errorMessage">{{errorMessage}}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="close" data-dismiss="modal">Cancel
                    </button>
                    <button @click="addClient" type="button" class="btn btn-primary">Add</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: "AddClientModal",
    props: {
    },
    data() {
        return {
            username: '',
            errorMessage: '',
        }
    },
    mounted() {

    },
    methods: {
        addClient() {
            this.errorMessage = '';
            let data = {name: this.username};
            axios.post(import.meta.env.VITE_BASE_URL + '/api/clients', data)
                .then(response => {
                    this.$emit('clicked', response.data)
                    this.username = '';
                    this.errorMessage = '';
                    document.getElementById('close').click();
                }).catch(error => {
                this.errorMessage = error.response.data.message

            });
        },
    }
}
</script>

<style scoped>

</style>
