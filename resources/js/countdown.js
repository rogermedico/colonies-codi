const setCountdown = (countdown, finish, interval) => {
    const now = new Date().getTime();

    const distance = finish - now;

    if (distance >= 0) {
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        countdown.textContent = `${hours}h ${minutes}m ${seconds}s`;
    } else {
      clearInterval(interval);

      countdown.textContent = 'Generadors bloquejats per sempre 😢';
    }
}

(() => {
    const countdown = document.getElementById('count-down');

    if (countdown) {
        const finish = new Date(countdown.dataset.finishDate).getTime();

        const interval = setInterval(setCountdown, 1000, countdown, finish);

        setCountdown(countdown, finish, interval);
    }
})();
