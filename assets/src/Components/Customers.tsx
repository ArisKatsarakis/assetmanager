import {Button, Container, Table} from "react-bootstrap";

export const Customers = () => {
    return (
        <Container>
            <Table striped bordered >
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Company Name</th>
                        <th>AFM</th>
                        <th>Tel</th>
                        <th colSpan={2}>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Etaireia Pelati</td>
                        <td>157289051</td>
                        <td>210 4567890</td>
                        <td>
                            <Button variant={'danger'}> Delete</Button>
                            <Button variant={'success'}>Edit </Button>
                        </td>

                    </tr>
                </tbody>
            </Table>
        </Container>
    );
};