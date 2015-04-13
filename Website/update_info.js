// Script 10.7- register2.js
// This script validates a form.

// Function called when the form is submitted.
// Function validates the form2 data.

//Function validates form2 data
function validateForm2(e) {
    'use strict';

    // Get the event object:
	if (typeof e == 'undefined') e = window.event;

    // Get form references:
	var name2 = U.$('name2');
	var userid2 = U.$('userid2');
	var email2 = U.$('email2');
	var phone2 = U.$('phone2');
	var gender2 = U.$('gender2');
	var initial2 =U.$('initial2');
	var school2 = U.$ ('school2');
    var address2 = U.$ ('address2');
	var bdate2 = U.$ ('bdate2');
	var bdate3 = new Date(bdate2.value);

	// Flag variable:
	var error = false;

	// Validate the name:
	if ((/^[A-Za-z \.\-]{2,40}$/.test(name2.value)) !=0) {
		removeErrorMessage('name2');
	} else {
		addErrorMessage('name2', 'Please enter your name.');
		error = true;
	}

	// Validate the user name:
	if ((/^(?=.*\d)(?=.*[A-Z]).{1,10}$/.test(userid2.value)) !=0) {
		removeErrorMessage('userid2');
	} else {
		addErrorMessage('userid2', 'Please enter your Matric No. All Capitalized Letter');
		error = true;
	}

	// Validate the email address:
	if (/^[\w.-]+@[\w.-]+\.[A-Za-z]{2,6}$/.test(email2.value)) {
		removeErrorMessage('email2');
	} else {
		addErrorMessage('email2', 'Please enter your email address.');
		error = true;
	}
	
	// Validate the phone number:
	if (/^\d{8}$/.test(phone2.value)) {
		removeErrorMessage('phone2');
	} else {
		addErrorMessage('phone2', 'Please enter your 8 digit phone number.');
		error = true;
	}
	
	
	// Validate the gender:
	if (gender2.selectedIndex != 0) {
		removeErrorMessage('gender2');
	} else {
		addErrorMessage('gender2', 'Please select your gender.');
		error = true;
	}
	
	// Validate the school:
	if (/^[A-Z]{2,5}$/.test(school2.value)) {
		removeErrorMessage('school2');
	} else {
			addErrorMessage('school2', 'Please enter your school\'s capitalized abbreviation ');
		error = true;
	}
	
	// Validate the Birthday:
	var tdate = new Date();
    if ( bdate3 < tdate ){
		removeErrorMessage('bdate2');
	} else {
			addErrorMessage('bdate2', 'Select date before today!');
		error = true;
	}

    // If an error occurred, prevent the default behavior:
	if (error) {

		// Prevent the form's submission:
	    if (e.preventDefault) {
	        e.preventDefault();
	    } else {
	        e.returnValue = false;
	    }
	    return false;
    
	}
    
}
*/
// Function called when the terms checkbox changes.
// Function enables and disables the submit button.

function toggleSubmit2() {
	'use strict';
    
	// Get a reference to the submit button:
	var submit2 = U.$('submit2');

	// Toggle its disabled property:
	if (U.$('terms2').checked) {
		submit2.disabled = false;
	} else {
		submit2.disabled = true;
	}
	
} // End of toggleSubmit() function.

// Establish functionality on window load:
window.onload = function() {
    'use strict';

	// The validateForm() function handles the form:
	U.addEvent(U.$('theForm2'), 'submit2', validateForm2);
	// Disable the submit button to start:
	U.$('submit2').disabled = true;
	// Watch for changes on the terms checkbox:
	U.addEvent(U.$('terms2'), 'change', toggleSubmit2);
	// Enbable tooltips on the phone number:
    U.enableTooltips('phone');
};