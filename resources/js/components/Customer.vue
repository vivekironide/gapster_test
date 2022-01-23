<template>
    <div>
        <h2 class="mt-3"> Customer </h2>

        <div class="row mt-4 mb-4">
            <div class="col-3">
                <input ref="file" accept=".csv" class="form-control" type="file" v-on:change="handleFileUpload">
            </div>
            <div class="col">
                <button class="btn btn-primary" type="submit" v-on:click="uploadCSVCustomer">Upload</button>
            </div>
        </div>

        <data-table :columns="columns" :framework="bootstrap" :url="url"></data-table>
    </div>
</template>

<script>
export default {
    data() {
        return {
            customers: [],
            search   : {
                key  : 0,
                value: ''
            },
            csv      : {
                file: ''
            },
            url      : window.location.origin + '/api/customers',
            columns  : [
                {
                    label    : 'ID',
                    name     : 'id',
                    orderable: false,
                },
                {
                    label    : 'Email',
                    name     : 'email',
                    orderable: false,
                },
                {
                    label    : 'Phone Number',
                    name     : 'phone_number',
                    orderable: false,
                },
                {
                    label    : 'First Name',
                    name     : 'first_name',
                    orderable: false,
                },
                {
                    label    : 'Last Name',
                    name     : 'last_name',
                    orderable: false,
                },
            ]
        }
    },
    methods: {
        deleteCustomer( id ) {
            axios.delete( 'api/customer/' + id ).then( ( response ) => {
                location.reload();
            } )
        },

        searchCustomer() {
            axios.get( 'api/customers?search=' + this.search.key + ':' + this.search.value ).then( ( response ) => {
                this.customers = response.data.data
            } )
        },

        uploadCSVCustomer() {
            let formData = new FormData();
            formData.append( 'file', this.csv.file );

            axios.post( 'api/customer/upload', formData ).then( ( response ) => {
                location.reload()
            } )
        },

        handleFileUpload() {
            this.csv.file = this.$refs.file.files[ 0 ];
        }
    },

    beforeMount() {
        console.log( this.url );
    }
}
</script>

<style scoped>

</style>
