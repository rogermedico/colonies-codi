(() => {
    const activationCountdown = document.getElementById('activation-countdown');

    if (activationCountdown) {
        let remainingSeconds = 12;

        const ko = document.getElementById('activated-ko');
        const ok = document.getElementById('activated-ok')

        const interval = setInterval(() => {
            remainingSeconds = remainingSeconds - 1;

            if (remainingSeconds >= 0) {
                activationCountdown.textContent = `0h 0m ${remainingSeconds}s`;
            } else {
              clearInterval(interval);

              activationCountdown.textContent = 'Generadors activats!';

              ko.classList.add('d-none');
              ok.classList.remove('d-none')
            }
        }, 1000);

    }
})();
