export interface Customer {
    "company_id": string;
    "company_name": string;
    "company_email": string;
    "company_afm": string;
    "comapny_address": string;
    "mobile": string;
    "phone": string;
}

export interface Risk {
    "tool_id": string;
    "tool_name": string;
}

export interface CustomerPromise {
    data : [ Customer ];
    status: number;
}

export interface RiskCategory {
    "category_id":      string;
    "category_name":    string;
    "report":           string;
    "invoice" :         string;
}

export interface RiskCategoryPromise {
    data: [RiskCategory];
    status: number;
}