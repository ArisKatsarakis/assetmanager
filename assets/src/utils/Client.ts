import axios from "axios";
import {RiskCategory} from "../Interfaces/interfaces";
import {urls} from "./variables";
export const createCategory = async(category: RiskCategory)=> {
    const response = await axios.post(urls.riskCategories, category);
    console.log(response);
}