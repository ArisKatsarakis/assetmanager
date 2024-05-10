import { Button, Form } from "react-bootstrap";
import { RiskCategory } from "../Interfaces/interfaces";
import FormCheckInput from "react-bootstrap/esm/FormCheckInput";
import { useState, FormEvent } from "react";
import {createCategory} from "../utils/Client";


// category: RiskCategory
export const RiskCategoryForm = () => {
    const [categoryName, setCategoryName] = useState('');
    const [invoice, setInvoice] = useState('');
    const [report, setReport] = useState(0);


    const handleSubmit = async (event : FormEvent<HTMLFormElement>) => {
        event.preventDefault();
        const category: RiskCategory = {
            category_name: categoryName,
            category_id: '',
            report: report.toString(),
            invoice: invoice.toString()
        }
        console.log(category)
        // await createCategory(category);
        // window.location.reload();
        
    }
    return (
        <>
            <Form onSubmit={handleSubmit}>
                <Form.Group>
                    <Form.Label>Category Name</Form.Label>
                    <Form.Control
                        type="text"
                        onChange={event => setCategoryName(event.currentTarget.value)}
                        value={categoryName}
                    />
                    <Form.Check // prettier-ignore
                        type="switch"
                        id="custom-switch"
                        value={invoice}
                        onChange={event => setInvoice(event.currentTarget.value)}
                        label="Invoice"
                    />
                    <Form.Switch // prettier-ignore
                        type="switch"
                        value={report}
                        onChange={event => setReport(parseInt(event.currentTarget.value))}
                        onInput={event => setReport(parseInt(event.currentTarget.value))}
                        label="Report"
                        id="disabled-custom-switch"
                    />


                </Form.Group>
                <Form.Group>
                    <Button type="submit"> Save Category</Button>
                </Form.Group>
            </Form>
        </>
    );
}
