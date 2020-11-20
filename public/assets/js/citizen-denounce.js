const progressBar = document.getElementById('progress-bar');
const inputs = document.querySelectorAll('input');

function calcScore() {
    let score = 0;
    inputs.forEach(
        input => {
            if (input.checked) {
                score += parseInt(input.value);
            }
        }
    );
    progressBar.style.width = score + '%';
}