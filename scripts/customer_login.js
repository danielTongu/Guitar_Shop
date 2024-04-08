// customer_login.js

"use strict";

document.addEventListener('DOMContentLoaded', function () {
    const $es = (e, s) => e.querySelector(s);
    const logIcon = $es(document, 'header > form' );
    
    logIcon.addEventListener('click', function () {
        logIcon.classList.toggle('clicked');
    });
    
    const eyeIcon = $es(document, 'main div i');
    
    eyeIcon.addEventListener('click', togglePassword);
    
    function togglePassword(){
        const passwordInput = $es(document, 'main input[name="password"]');
            
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.classList.replace("fa-eye-slash", "fa-eye");
        } else {
            passwordInput.type = 'password';
            eyeIcon.classList.replace("fa-eye", "fa-eye-slash");
        };
    }
    
});

