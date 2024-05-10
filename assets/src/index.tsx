import React from "react";
import ReactDOM from "react-dom";
import { App } from "./Components/App";
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap/dist/js/bootstrap.bundle.js';
import { Customers } from "./Components/Customers";
import { Assets } from "./Components/Assets";
document.addEventListener('DOMContentLoaded', () => {
  const element = document.getElementById('asset-admin') as HTMLElement;
  if (typeof element !== 'undefined' && element !== null) {
    ReactDOM.render(
      <React.StrictMode>
        <App />
      </React.StrictMode>
      , document.getElementById('asset-admin'))
  }
  const customers = document.getElementById('customer-react') as HTMLElement;
  if (typeof customers !== 'undefined' && customers !== null) {
    ReactDOM.render(
      <React.StrictMode>
        <Customers />
      </React.StrictMode>
      , document.getElementById('customer-react'))
  }
  const assets = document.getElementById('assets-react') as HTMLElement;
  if (typeof assets !== 'undefined' && assets !== null) {
    ReactDOM.render(
      <React.StrictMode>
        <Assets />
      </React.StrictMode>
      , document.getElementById('assets-react'))
  }
})
