import { useEffect, useState } from "react";
import { RiskCategory, RiskCategoryPromise } from "../Interfaces/interfaces";
import axios from "axios";
import { urls } from "../utils/variables";
import { Tick, X } from "../Icons/CommonIcons";
import { Accordion, Button, Table } from "react-bootstrap";
import { RiskCategoryForm } from "./RiskCategoryForm";
export const Assets = () => {
    const [formEnable, setFormEnable] = useState(false);
    const [riskCategories, setRiskCategories] = useState<RiskCategory[]>([]);
    const fetchRiskCategories = async () => {
        const results: RiskCategoryPromise = await fetchRiskCategoriesApi();
        setRiskCategories(results.data);
    }

    const fetchRiskCategoriesApi = () => {
        return axios.get(urls.riskCategories);
    }

    const enableForm = () => {
        setFormEnable(true);
    }

    const disableForm = () => {
        setFormEnable(false);
    }

    const addNewCustomerForm = () => {
        if (formEnable == false ) {
            enableForm();
        }else { 
            disableForm();
        }
    }
    useEffect(() => {
        fetchRiskCategories();
    }, []);
    return (
        <>
            <h2>Assets</h2>
            <Button variant="success" onClick={addNewCustomerForm}> Add Risk Category </Button>
            <Accordion>
                {
                    riskCategories.map(
                        category => {
                            return (
                                <Accordion.Item eventKey={category.category_id}>
                                    <Accordion.Header>
                                        <span >
                                            Name: {category.category_name}
                                            <br />
                                        </span>
                                    </Accordion.Header>
                                    <Accordion.Body>
                                        <div>
                                            <span>
                                                Report: {category.report === "1" ? <Tick /> : <X />} Invoice: {category.invoice === "1" ? <Tick /> : <X />}
                                            </span>
                                        </div>
                                        <Table>
                                            <thead>
                                                <th>Tool Name</th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    
                                                </tr>
                                            </tbody>
                                        </Table>
                                    </Accordion.Body>
                                </Accordion.Item>

                            );
                        }
                    )
                }

            </Accordion>
           { formEnable && <RiskCategoryForm /> } 

        </>
    );
};