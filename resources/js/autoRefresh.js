(() => {
    if (! document.getElementById('no-autorefresh')) {
        setTimeout(() => window.location.reload(1), 60000);
    }
})();
