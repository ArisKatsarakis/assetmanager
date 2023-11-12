import React from "react";
import ReactDOM  from "react-dom";
import {App} from "./Components/App";
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap/dist/js/bootstrap.bundle';
document.addEventListener('DOMContentLoaded', () => {
    const element = document.getElementById('asset-admin') as HTMLElement;
    if (typeof element !== 'undefined' &&  element !== null) {
        ReactDOM.render(
            <React.StrictMode>
                <App />
            </React.StrictMode>
        , document.getElementById('asset-admin'))
    }
})