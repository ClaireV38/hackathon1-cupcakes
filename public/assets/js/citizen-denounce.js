const progressBar = document.getElementById('progress-bar');
const inputs = document.querySelectorAll('input');
const scoreInput = document.getElementById('score');

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
    scoreInput.value = score>100? 100 :
        score<0? 0 : score;
}