const progressBar = document.getElementById('progress-bar');
const inputs = document.querySelectorAll('input');
const scoreInput = document.getElementById('score');
calcScore();

function calcScore() {
    let score = 0;
    inputs.forEach(
        input => {
            if (input.checked) {
                console.log(input.value);
                score += parseInt(input.value);
            }
        }
    );
    score = score>100? 100 :
        score<0? 0 : score;
    console.log(score);
    progressBar.style.width = score + '%';
    scoreInput.value = score
}