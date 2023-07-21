(() => {
    const video = document.getElementById('end-video');

    if (video) {
        setTimeout(() => {
            video.play();
        }, video.dataset.delay);
    }

    const activationCountdown = document.getElementById('activation-countdown');

    if (activationCountdown) {
        let remainingSeconds = 12;

        const interval = setInterval(() => {
            remainingSeconds = remainingSeconds - 1;

            if (remainingSeconds >= 0) {
                activationCountdown.textContent = `0h 0m ${remainingSeconds}s`;
            } else {
              clearInterval(interval);

              activationCountdown.textContent = 'Generadors activats!';
            }
        }, 1000);

    }
})();
