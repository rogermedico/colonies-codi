import * as bootstrap from 'bootstrap';

const submitForm = (event) => {
    console.log('event',event)
    event.target.submit();
}

(() => {
    if (document.getElementById('loadingModal')) {
        const loadingModal = new bootstrap.Modal('#loadingModal', {
            'backdrop': 'static',
            'focus': false,
            'keyboard': false,
        });

        const validateCodeButtons = document.getElementsByClassName('validate-code-form');

        Object.values(validateCodeButtons).forEach(button => {
            button.addEventListener('submit', (event) => {
                event.preventDefault();

                loadingModal.show();

                setTimeout(() => event.target.submit(), Math.floor(Math.random() * (7000 - 4000 + 1) + 4000));
            });
        });
    }
})();
