import { Container } from "react-bootstrap";
import React from "react";
import jsPDF from "jspdf";
export const Invoices = () => {
	const generatePDF = () => {
		var doc = new jsPDF("p", "pt");
		doc.text( "This is the first title.", 20, 20);
//		doc.addFont("helvetika", );
		doc.text("This is the second title.", 20, 60);
		doc.text("This is the thri title.", 20, 100);
		doc.save("demo.pdf");
	};
    return (
        <Container> 
		
		return (
			<div>
			<button onClick={generatePDF}>
				Download PDF
			</button>
			</div>
	       );
	</Container>
    );
};
