<template>
    <div>
        <h2 class="mt-4"> Create Customer</h2>

        <div v-if="alertMsg" class="alert alert-success alert-dismissible fade show" role="alert">
            <div>{{ msg }}.</div>
            <button aria-label="Close" class="btn-close" type="button" v-on:click="hideAlert"></button>
        </div>

        <form class="mt-4">
            <div class="mb-3">
                <label class="form-label" for="email">Email</label>
                <input id="email" v-model="form.email" aria-describedby="name" class="form-control" required type="email">
                <div v-if="errors.email" class="valid-feedback text-danger">{{ errors.email[ 0 ] }}</div>
            </div>

            <div class="mb-3">
                <label class="form-label" for="phone_number">Phone Number</label>
                <input id="phone_number" v-model="form.phone_number" class="form-control" required type="number">
                <div v-if="errors.phone_number" class="valid-feedback text-danger">{{ errors.phone_number[ 0 ] }}</div>
            </div>

            <div class="mb-3">
                <label class="form-label" for="first_name">First Name</label>
                <input id="first_name" v-model="form.first_name" class="form-control" required type="text">
                <div v-if="errors.first_name" class="valid-feedback text-danger">{{ errors.first_name[ 0 ] }}</div>
            </div>
            <div class="mb-3">
                <label class="form-label" for="last_name">Last Name</label>
                <input id="last_name" v-model="form.last_name" class="form-control" required type="text">
                <div v-if="errors.last_name" class="valid-feedback text-danger">{{ errors.last_name[ 0 ] }}</div>
            </div>

            <button class="btn btn-primary" type="submit" @click.prevent="updateForm">Submit</button>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            form    : {
                email       : '',
                phone_number: '',
                first_name  : '',
                last_name   : ''
            },
            errors  : [],
            alertMsg: false,
            msg     : '',
            axios   : axios.create( {
                baseURL: window.location.origin
            } )
        }
    },
    methods: {
        getCustomer() {
            let url = 'api/customer/' + this.$route.params.id + '/edit';
            this.axios.get( url ).then( ( response ) => {
                this.form = response.data;
                console.log( response.data );
            } );
        },

        updateForm() {
            this.axios.put( 'api/customer/' + this.$route.params.id, this.form ).then( ( response ) => {
                this.alertMsg = true;
                this.msg      = response.data.message;
                this.$router.push( '/customers' )
            } ).catch( ( errors ) => {
                if( errors.response.status === 422 ) {
                    this.errors = errors.response.data.errors;
                }
                else {
                    console.log( errors.response.data.errors )
                }
            } )
        },

        hideAlert() {
            this.alertMsg = false;
        }
    },

    beforeMount() {
        this.getCustomer()
    }
}
</script>

<style scoped>

</style>
