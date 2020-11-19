const video = document.getElementById("video");
const canvas = document.getElementById('photo');

function startVideo() {
    navigator.getUserMedia = ( navigator.getUserMedia ||
        navigator.webkitGetUserMedia ||
        navigator.mozGetUserMedia ||
        navigator.msGetUserMedia
    );
    navigator.mediaDevices.getUserMedia({
        video: true
    }).then(
        stream => (video.srcObject = stream),
        err => console.log(err)
    );
}

startVideo();

function snapshot() {
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    canvas.getContext('2d').drawImage(video, 0, 0);
    const snapshot = canvas.toDataURL("image/png");
    const photoData = document.querySelector('#photo-data');
    photoData.value = snapshot;
}