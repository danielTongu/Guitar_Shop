// customer.js


"use strict";

// Event handler for DOMContentLoaded
document.addEventListener('DOMContentLoaded', () => {
    const $fs = (form, selector) => form.querySelector(selector);
    
    const customerForm = $fs(document, "main > section form:nth-of-type(1)");
    const billingAddressForm = $fs(document, "main > section form:nth-of-type(2)");
    const shippingAddressForm = $fs(document, "main > section form:nth-of-type(3)");
    const passwordInputEyeIcon = $fs(document, "main > section input[name='password'] + i");
    const passwordConfirmInputEyeIcon = $fs(document, "main > section input[name='confirm_password'] + i");
    
    // Event listeners
    
    customerForm.addEventListener("submit", function (event) {
        if (!validateCustomerInfo()) {
            event.preventDefault();
        }
    });

    billingAddressForm.addEventListener("submit", function (event) {
        if (!validateBillingAddress()) {
            event.preventDefault();
        }
    });

    shippingAddressForm.addEventListener("submit", function (event) {
        if (!validateShippingAddress()) {
            event.preventDefault();
        }
    });
    
    passwordInputEyeIcon.addEventListener("click", togglePassword);
    passwordConfirmInputEyeIcon.addEventListener("click", toggleConfirmPassword);
    
    
    // Event functions
    
    function validateCustomerInfo() {
        const emailRegex = /^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/ ;
        const passwordRegex = /^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}$/ ;

        const validationData = [
            { element: 'first_name', regex: null },
            { element: 'last_name', regex: null },
            { element: 'email_address', regex: emailRegex },
            { element: 'password', regex: passwordRegex },
            { element: 'confirm_password', regex: passwordRegex }
        ];

        let isValid = true;

        validationData.forEach( data => {
            const label = $fs(customerForm, `label[for="${data.element}"]`);
            const inputElement = $fs(customerForm, `input[name="${data.element}"]`);
            const inputValue = inputElement.value.trim();

            if (data.element !== 'password' && data.element !== 'confirm_password') {
                isValid = isValid && isValidInput(label, true, data.regex);
            } 
            else if (data.element === 'password' && inputValue !== '') {
                isValid = isValid && isValidInput(label, false, data.regex);
            } 
            else if (data.element === 'confirm_password' && inputValue !== '') {
                const passwordElement = $fs(customerForm, 'input[name="password"]');
                const passwordValue = passwordElement.value.trim();
                const confirmationElement = inputElement.nextElementSibling;

                isValid = isValid && inputValue === passwordValue;
                isValid = isValid && isValidInput(label, true, data.regex);
            }
        });

        return isValid;
    }

    function validateBillingAddress() {
        return validateAddress(billingAddressForm);
    }

    function validateShippingAddress() {
        return validateAddress(shippingAddressForm);
    }
    
    function togglePassword(){
        const password = $fs(document, "main > section input[name='password']");
        togglePasswordEyeIcon(passwordInputEyeIcon, password);
    }
    
    function toggleConfirmPassword(){
        const password = $fs(document, "main > section input[name='confirm_password']");
        togglePasswordEyeIcon(passwordConfirmInputEyeIcon, password);
    }
    
    
    

    // Event functions helpers

    function validateAddress(addressForm) {
        const zipRegex = /^\d{5}(-\d{4})?(?!-)/;
        const phoneRegex = /^(1\s?)?(\d{3}|\(\d{3}\))[\s\-]?\d{3}[\s\-]?\d{4}$/gm;

        const validationData = [
            { element: 'line1', regex: null },
            { element: 'line2', regex: null },
            { element: 'city', regex: null },
            { element: 'state', regex: null },
            { element: 'zip_code', regex: zipRegex },
            { element: 'phone', regex: phoneRegex }
        ];

        let isValid = true;

        validationData.forEach(data => {
            const label = $fs(addressForm, `label[for="${data.element}"]`);
            isValid = isValid && isValidInput(label, data.element !== 'line2', data.regex);
        });

        return isValid;
    }

    function isValidInput(labelElement, isRequired, regex) {
        const inputLabel = labelElement.textContent.trim().replace(/:/g, '');
        const inputElement = labelElement.nextElementSibling;
        const inputValue = inputElement.value.trim();
        const confirmationElement = inputElement.nextElementSibling;

        let isValid = true;

        if (confirmationElement) {
           confirmationElement.textContent = ''; 
        }

        if (isRequired && inputValue === '') {
            isValid = false;
            showError(confirmationElement, inputLabel + ' required.');
        }

        if (inputValue !== '' && regex && !regex.test(inputValue)) {
            isValid = false;
            showError(confirmationElement, 'Invalid format for ' + inputLabel);
        }

        toggleClass(inputElement, !isValid);
        return isValid;
    }

    function showError(confirmationElement, message) {
        if(confirmationElement && !message) {
            confirmationElement.value = ''; 
        } else if (confirmationElement) {
            confirmationElement.value = message;
        } else {
            alert(message);
        }
    }

    function toggleClass(inputElement, addClass) {
        if (addClass) {
            inputElement.classList.add('invalid');
        } else {
            inputElement.classList.remove('invalid');
        }
    }
    
    function togglePasswordEyeIcon(eyeIcon, passwordInput){
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.classList.replace("fa-eye-slash", "fa-eye");
        } else {
            passwordInput.type = 'password';
            eyeIcon.classList.replace("fa-eye", "fa-eye-slash");
        };
    }
    
});
