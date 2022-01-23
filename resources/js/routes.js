import CreateCustomer from "./components/CreateCustomer";
import Customer       from "./components/Customer";
import UpdateCustomer from "./components/UpdateCustomer";

export default {
    mode: 'history',

    routes: [
        {
            path     : '/customers',
            component: Customer
        },
        {
            path     : '/customer/create',
            component: CreateCustomer
        },
        {
            path     : '/customer/:id',
            component: UpdateCustomer
        }
    ]
}
