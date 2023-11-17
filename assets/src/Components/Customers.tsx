import { useEffect, useState } from "react";
import { Button, Container, Table } from "react-bootstrap";
import { Customer } from "../Interfaces/interfaces";
import axios from "axios";
import {CustomerForm} from './CustomerForm';
export const Customers = () => {
    const [customers, setCustomers] = useState<Customer[]>([])
    const  [showCustomerForm, setShowCustomerForm]= useState<boolean>(false);
    const [message, setMessage] = useState<string>('');
    const [fetchedCustomer, setFetchedCustomer] = useState<Customer>(
        {
            "company_id": "10001",
            "company_name": "Company",
            "company_email": "company@email.com",
            "company_afm": "157289051",
            "comapny_address": "Tassou Issaak 4 "
        }
    );
    useEffect(
        () => {
            getCustomersFromApi();
        }
        , []
    );
    const getCustomersFromApi = async () => {
        const customers = await axios.get('http://localhost/wp-json/assetmanagerplugin/v1/customers');
        console.log(customers.data);
        //@ts-ignore
        setCustomers(customers.data);

    }
    const showHideCustomerForm = () => {
            setShowCustomerForm(!showCustomerForm);
    }

    const editCustomer = async (event: React.MouseEvent<HTMLElement> ) => {
        //@ts-ignore
        const customerId = event.currentTarget.value;
        const results = await fetchCustomerByApi(customerId);
    }

    const fetchCustomerByApi = async (customerId :string) => {
        return await axios.get(`http://localhost/wp-json/assetmanagerplugin/v1/customers/${customerId}`);
    }

    const deleteCustomerByIdApi = (customerId : string) => {
        console.log(customerId);
    }
    const deleteCustomer = ( event: React.MouseEvent<HTMLElement> ) => {
        //@ts-ignore
        const customerId = event.currentTarget.value;
        deleteCustomerByIdApi(customerId)
    }
    return (
        <Container>
            <Table striped bordered >
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Company Name</th>
                        <th>Company Email</th>
                        <th>Company Afm</th>
                        <th>Company Address</th>
                        <th colSpan={2}>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    {
                        customers.map(
                            customer => {
                                return (
                                    <tr key={customer.company_id}>
                                        <td>{customer.company_id}</td>
                                        <td>{customer.company_name}</td>
                                        <td>{customer.company_email}</td>
                                        <td>{customer.company_afm}</td>
                                        <td>{customer.comapny_address}</td>
                                        <td>
                                            <Button variant={'danger'} onClick={deleteCustomer} value={customer.company_id}> Delete</Button>
                                            <Button variant={'success'} onClick={editCustomer} value={customer.company_id}>Edit </Button>
                                        </td>
                                    </tr>
                                )
                            }
                        )
                    }
                </tbody>
            </Table>
            <Button onClick={showHideCustomerForm} variant="outline-dark"> Add New Customer </Button>
           { showCustomerForm && <CustomerForm customer={fetchedCustomer} /> }
           {message}
        </Container>
    );

    
};