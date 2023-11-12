import {Button, Col, Container, Row} from 'react-bootstrap';
import {Customers} from "./Customers";
import {Header, router} from "./Header";
import {Assets} from "./Assets";
import {Invoices} from "./Invoices";
export const App = () => {
    if(router == 'customers') {
        return (
            <Container>
                <Header />
                <Row>
                    <Customers />
                </Row>

            </Container>

        );
    }else if(router == 'assets') {
        return (
            <Container>
                <Header />
                <Row>
                    <Assets />
                </Row>

            </Container>

        );
    }else if(router == 'invoices') {
        return (
            <Container>
                <Header />
                <Row>
                    <Invoices />
                </Row>

            </Container>

        );
    }

};