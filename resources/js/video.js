(() => {
    const video = document.getElementById('end-video');

    if (video) {
        video.addEventListener('canplay', () => {
            console.log('inside event')
            setTimeout(() => {
                video.play();
            }, 5000);
        });
    }
})();
