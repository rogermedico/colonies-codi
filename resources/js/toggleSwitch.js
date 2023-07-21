import * as bootstrap from 'bootstrap';

const submitForm = (event) => {
    console.log('event',event)
    event.target.submit();
}

(() => {
    if (document.getElementById('activateFolderLoadingModal')) {
        const loadingModal = new bootstrap.Modal('#activateFolderLoadingModal', {
            'backdrop': 'static',
            'focus': false,
            'keyboard': false,
        });

        const activateFolderSwitches = document.getElementsByClassName('activate-folder-switch');

        Object.values(activateFolderSwitches).forEach(checkbox => {
            checkbox.addEventListener('change', () => {
                if (checkbox.checked) {
                    document.getElementById('activate-folder-loading-modal-title').textContent = '🔓 Desbloquejant fase';
                }   else {
                    document.getElementById('activate-folder-loading-modal-title').textContent = '🔒 Bloquejant fase';
                }

                loadingModal.show();

                setTimeout(() => window.location.replace(checkbox.dataset.callbackUrl), Math.floor(Math.random() * (7000 - 4000 + 1) + 4000));
            });
        });
    }
})();
