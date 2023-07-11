import * as bootstrap from 'bootstrap';

const alert = document.getElementsByClassName('alert')[0];

if (alert) {
    const bootstrapAlert = bootstrap.Alert.getOrCreateInstance(alert);

    const closeAlertTimeout = setTimeout(() => {
        bootstrapAlert.close();
    }, 5000);

    alert.addEventListener('close.bs.alert', () => {
        clearTimeout(closeAlertTimeout);
    });
}
