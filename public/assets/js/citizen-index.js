const video = document.getElementById("video");
const canvas = document.getElementById('photo');
const snapshotButton = document.getElementById('snapshot-button');
snapshotButton.addEventListener('click', snapshot);

const retaketButton = document.getElementById('retake-button');
retaketButton.addEventListener('click', retake)

const takePicButton = document.getElementById('take-pic-button');
const uploadButton = document.getElementById('upload-button');
const uploadMenu = document.getElementById('upload-menu');
const snapshotdMenu = document.getElementById('snapshot-menu');
takePicButton.addEventListener('click', displaySnapshotMenu);
uploadButton.addEventListener('click', displayUploadMenu)

navigator.getUserMedia = ( navigator.getUserMedia ||
    navigator.webkitGetUserMedia ||
    navigator.mozGetUserMedia ||
    navigator.msGetUserMedia
);

function startVideo() {
    navigator.mediaDevices.getUserMedia({video: true})
        .then(stream => video.srcObject = stream)
        .catch(err => console.log(err));
}

function stopVideo() {
    const stream = video.srcObject;
    const tracks = stream.getTracks();
    tracks.forEach(function(track) {
        track.stop();
    });
    video.srcObject = null;
}

function snapshot() {
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    canvas.getContext('2d').drawImage(video, 0, 0);
    const snapshot = canvas.toDataURL("image/png");
    const photoData = document.querySelector('#photo-data');
    photoData.value = snapshot;
    canvas.style.display = "block";
    video.style.display = "none";
}

function retake() {
    canvas.style.display = "none";
    video.style.display = "block";
}

function displaySnapshotMenu() {
    uploadMenu.style.display = "none";
    snapshotdMenu.style.display = "block";
    startVideo();
}

function displayUploadMenu() {
    uploadMenu.style.display = "block";
    snapshotdMenu.style.display = "none";
    stopVideo();
}