(() => {
    const video = document.getElementById('end-video');

    if (video) {
        setTimeout(() => {
            video.play();
        }, 5000);
    }
})();
