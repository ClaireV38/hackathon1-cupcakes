const progressBar = document.getElementById('progress-bar');
const inputs = document.querySelectorAll('input');
const scoreInput = document.getElementById('score');
const similirityValue = parseInt(document.getElementById('similarity').value);
calcScore();

function calcScore() {
    let score = similirityValue;
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