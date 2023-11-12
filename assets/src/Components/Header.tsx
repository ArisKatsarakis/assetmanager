import {Button, Container, Nav, Navbar} from "react-bootstrap";
import React from "react";
import ReactDOM from "react-dom";
import {Assets} from "./Assets";
import {App} from "./App";
let router :string = 'customers';
const  Header = () => {



    function setRouterCustomers() {
        router = 'customers';
        ReactDOM.render(<App />, document.getElementById('asset-admin'))
    }

    function setRouterAssets() {
        router = 'assets';
        ReactDOM.render(<App />, document.getElementById('asset-admin'))
    }

    function setRouterInvoices() {
        router = 'invoices';
        ReactDOM.render(<App />, document.getElementById('asset-admin'))

    }

    return (
        <>
                <Container>
                    <Button variant={'outline-dark'} onClick={setRouterCustomers}>Customers</Button>
                    <Button variant={'outline-dark'} onClick={setRouterAssets}>Assets</Button>
                    <Button variant={'outline-dark'} onClick={setRouterInvoices}>Invoices</Button>
                </Container>
        </>
    );
};

export {router, Header};
