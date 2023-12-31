import { FormEvent, useEffect, useState } from "react";
import { Button, Col, Container, Form, InputGroup, Row, Table, Modal} from "react-bootstrap";
import { Customer, CustomerPromise } from "../Interfaces/interfaces";
import axios from "axios";
import { useNavigate } from "react-router-dom";
import { urls } from "../utils/variables";
export const Customers = () => {
    const [customers, setCustomers] = useState<Customer[]>([])
    const [showCustomerForm, setShowCustomerForm] = useState<boolean>(false);
    const [message, setMessage] = useState<string>('');
    const [companyName, setCompanyName] = useState<string>('');
    const [companyAFM, setCompanyAFM] = useState<string>('');
    const [companyEmail, setCompanyEmail] = useState<string>('');
    const [companyAddress, setCompanyAddress] = useState<string>('');
    const [companyId, setCompanyId] = useState<string>('');
    const [mobile, setMobile] = useState<string>('');
    const [phone, setPhone] = useState<string>('');
    const [companyDeleted, setComapnyDeleted] = useState<string>('');
    const [show, setShow] = useState(false);

    const handleClose = () => setShow(false);
    const handleShow = ( event: React.MouseEvent<HTMLElement> ) =>  {
        //@ts-ignore
        const customerId = event.currentTarget.value;
        setComapnyDeleted(customerId);
        setShow(true);
    }
    useEffect(
        () => {
            getCustomersFromApi();
        }
        , []
    );
    const getCustomersFromApi = async () => {
        const customers = await axios.get(urls.customers);
        console.log(customers.data);
        //@ts-ignore
        setCustomers(customers.data);

    }
    const showHideCustomerForm = () => {
        setShowCustomerForm(!showCustomerForm);
    }

    const editCustomer = async (event: React.MouseEvent<HTMLElement>) => {
        //@ts-ignore
        const customerId = event.currentTarget.value;
        const results: CustomerPromise = await fetchCustomerByApi(customerId);
        console.log(results);
        setCompanyAFM(results.data[0].company_afm);
        setCompanyAddress(results.data[0].comapny_address);
        setCompanyEmail(results.data[0].company_email);
        setCompanyName(results.data[0].company_name);
        setCompanyId(results.data[0].company_id);
        setMobile(results.data[0].mobile);
        setPhone(results.data[0].phone);
        setShowCustomerForm(!showCustomerForm);
    }

    const fetchCustomerByApi = async (customerId: string) => {
        return await axios.get(`${urls.customers}/${customerId}`);
    }

    const deleteCustomerByIdApi = async (customerId: string) => {
        console.log(customerId);
        const result = await axios.delete(urls.customers + '/' + customerId);
        console.log(result);
        window.location.reload();
    }

    const deleteCustomer = async (event: React.MouseEvent<HTMLElement>) => {
        //@ts-ignore
        const customerId = event.currentTarget.value;
        await deleteCustomerByIdApi(customerId);
        setShow(false);
        window.location.reload();

    }

    const updateCustomer = () => {
        updateCustomerByIdApi();

    }

    const updateCustomerByIdApi = async () => {
        const updatedData = {
            "company_id": companyId,
            "company_name": companyName,
            "company_email": companyEmail,
            "company_afm": companyAFM,
            "comapny_address": companyAddress,
            "mobile": mobile,
            "phone": phone,
        };
        const result = await axios.put(urls.customers + "/" + companyId, updatedData);
        console.log(result);
        window.location.reload();
    }
    const handleSubmit = (event: FormEvent<HTMLFormElement>) => {

        event.preventDefault();
        if (companyId === '') {
            insertNewCustomer();
        } else {
            console.log('updating');
            updateCustomer();
        }
    }

    const insertNewCustomer = () => {
        const customerData = {
            companyName: companyName,
            companyAfm: companyAFM,
            companyEmail: companyEmail,
            companyAddress: companyAddress,
            mobile: companyAddress,
            phone: companyAddress
        };
        console.log(customerData);
        createNewCustomerApi(customerData);
    }

    const createNewCustomerApi = async (requestData: object) => {
        const response = await axios.post(urls.customers, requestData);
        console.log(response.data);
        window.location.reload();
    }

    return (
        <Container>
            <Table striped bordered responsive >
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Company Name</th>
                        <th>Company Email</th>
                        <th>Company Afm</th>
                        <th>Company Address</th>
                        <th> Number</th>
                        <th> Mobile</th>
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
                                        <td>{customer.mobile}</td>
                                        <td>{customer.phone}</td>
                                        <td>
                                            <Button variant={'danger'} onClick={handleShow} value={customer.company_id} > Delete</Button>
                                            <Button variant={'success'} onClick={editCustomer} value={customer.company_id}>Edit </Button>
                                            <Modal show={show} onHide={handleClose}>
                                                <Modal.Header closeButton>
                                                    <Modal.Title>Delete Confirmation</Modal.Title>
                                                </Modal.Header>
                                                <Modal.Body>Are you sure for deleting Customer:  {customer.company_name} ?</Modal.Body>
                                                <Modal.Footer>
                                                    <Button variant="secondary" onClick={handleClose}>
                                                        Close
                                                    </Button>
                                                    <Button variant="danger" onClick={deleteCustomer} value={companyDeleted} >
                                                        Confirm
                                                    </Button>
                                                </Modal.Footer>
                                            </Modal>
                                        </td>
                                    </tr>
                                )
                            }
                        )
                    }
                </tbody>
            </Table>
            <Button onClick={showHideCustomerForm} variant="outline-dark"> Add New Customer </Button>
            {showCustomerForm &&
                <Form onSubmit={handleSubmit}>
                    <Row className="mb-3">
                        <Form.Group as={Col} md="7" controlId="validationCustom01">
                            <Form.Label>Company Name</Form.Label>
                            <Form.Control
                                required
                                type="text"
                                placeholder="Company Name"
                                value={companyName}
                                onChange={event => (setCompanyName(event.currentTarget.value))}
                            />
                            <Form.Control.Feedback>Looks good!</Form.Control.Feedback>
                        </Form.Group>
                        <Form.Group as={Col} md="5" controlId="validationCustomUsername">
                            <Form.Label>Company Email</Form.Label>
                            <InputGroup hasValidation>
                                <InputGroup.Text id="inputGroupPrepend">@</InputGroup.Text>
                                <Form.Control
                                    type="text"
                                    placeholder="Email"
                                    aria-describedby="inputGroupPrepend"
                                    required
                                    value={companyEmail}
                                    onChange={event => (setCompanyEmail(event.currentTarget.value))}
                                />
                                <Form.Control.Feedback type="invalid">
                                    Type a proper email
                                </Form.Control.Feedback>
                            </InputGroup>
                        </Form.Group>
                    </Row>
                    <Row className="mb-3">
                        <Form.Group as={Col} md="6" controlId="validationCustom03">
                            <Form.Label>Company AFM</Form.Label>
                            <Form.Control
                                type="text"
                                placeholder="Α.Φ,Μ Εταιρίας"
                                required
                                value={companyAFM}
                                onChange={event => (setCompanyAFM(event.currentTarget.value))}

                            />
                            <Form.Control.Feedback type="invalid">
                                Please provide a valid city.
                            </Form.Control.Feedback>
                        </Form.Group>
                        <Form.Group as={Col} md="6" controlId="validationCustom04">
                            <Form.Label>Company Address</Form.Label>
                            <Form.Control
                                type="text"
                                placeholder="Address"
                                required
                                value={companyAddress}
                                onChange={event => { setCompanyAddress(event.currentTarget.value) }}
                            />
                            <Form.Control.Feedback type="invalid">
                                Please provide a valid state.
                            </Form.Control.Feedback>
                        </Form.Group>
                        <Form.Group as={Col} md={6}>
                            <Form.Label htmlFor="mobile">Mobile</Form.Label>
                            <Form.Control
                                type="mobile"
                                id="mobile"
                                value={mobile}
                                onChange={event => setMobile(event.currentTarget.value)}
                            />
                        </Form.Group>
                        <Form.Group as={Col} md={6}>
                            <Form.Label htmlFor="phone">Phone</Form.Label>
                            <Form.Control
                                type="mobile"
                                id="phone"
                                value={phone}
                                onChange={event => setPhone(event.currentTarget.value)}
                            />
                        </Form.Group>

                    </Row>
                    <Button type="submit">Submit form</Button>
                </Form>
            }
            {message}
        </Container>
    );


};