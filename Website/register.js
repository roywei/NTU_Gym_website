// Script 10.7- register.js
// This script validates a form.

// Function called when the form is submitted.
// Function validates the form1 data.
function validateForm(e) {
    'use strict';

    // Get the event object:
	if (typeof e == 'undefined') e = window.event;

    // Get form references:
	var name = U.$('name');
	var matric_number = U.$('matric_number');
	var email = U.$('email');
	var phone = U.$('phone');
	var gender = U.$('gender');
	var initial =U.$('initial');
	var second =U.$('second');
	var school = U.$ ('school');
	var address = U.$ ('address');
	var bdate = U.$ ('bdate');
	var bdate2 = new Date(bdate.value);

	// Flag variable:
	var error = false;

	// Validate the name:
	if ((/^[A-Za-z \.\-]{2,40}$/.test(name.value)) !=0) {
		removeErrorMessage('name');
	} else {
		addErrorMessage('name', 'Please enter your name.');
		error = true;
	}
	
	// Validate the user name:
	if ((/^(?=.*\d)(?=.*[A-Z]).{1,10}$/.test(matric_number.value)) !=0) {
		removeErrorMessage('matric_number');
	} else {
		addErrorMessage('matric_number', 'Enter your Matric No. All Capitalized');
		error = true;
	}
	//Validate Password:
	if (/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{3,10}$/.test(initial.value)) {
		removeErrorMessage('initial');
	} else {
		addErrorMessage('initial', 'Wrong Password Format');
		error = true;
	}
	if (initial.value == second.value){
		removeErrorMessage('second');
	} else {
		addErrorMessage('second', 'Your input doesn\'t match with first');
		error = true;
	}
	
	// Validate the email address:
	if (/^[\w.-]+@[\w.-]+\.[A-Za-z]{2,6}$/.test(email.value)) {
		removeErrorMessage('email');
	} else {
		addErrorMessage('email', 'Please enter your email address.');
		error = true;
	}
	
	// Validate the phone number:
	if (/^\d{8}$/.test(phone.value)) {
		removeErrorMessage('phone');
	} else {
		addErrorMessage('phone', '8 digit phone number Only.');
		error = true;
	}
	
	
	// Validate the gender:
	if (gender.selectedIndex != 0) {
		removeErrorMessage('gender');
	} else {
		addErrorMessage('gender', 'Please select your gender.');
		error = true;
	}
	
	// Validate the school:
	if (/^[A-Z]{2,5}$/.test(school.value)) {
		removeErrorMessage('school');
	} else {
			addErrorMessage('school', 'Please enter your school\'s capitalized abbreviation ');
		error = true;
	}
	
	// Validate the Birthday:
	var tdate = new Date();
    if ( bdate2 < tdate ){
		removeErrorMessage('bdate');
	} else {
			addErrorMessage('bdate', 'Select date before today!');
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
    
} // End of validateForm() function.

// Function called when the terms checkbox changes.
// Function enables and disables the submit button.
function toggleSubmit() {
	'use strict';
    
	// Get a reference to the submit button:
	var submit = U.$('submit');

	// Toggle its disabled property:
	if (U.$('terms').checked) {
		submit.disabled = false;
	} else {
		submit.disabled = true;
	}
	
} // End of toggleSubmit() function.


// Establish functionality on window load:
window.onload = function() {
    'use strict';

	// The validateForm() function handles the form:
    U.addEvent(U.$('theForm'), 'submit', validateForm);

	// Disable the submit button to start:
	U.$('submit').disabled = true;

	// Watch for changes on the terms checkbox:
    U.addEvent(U.$('terms'), 'change', toggleSubmit);

	// Enbable tooltips on the phone number:
	U.enableTooltips('phone');
	
};