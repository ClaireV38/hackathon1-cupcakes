<?php

namespace App\Controller;

use App\Model\QuestionManager;
use App\Model\WitchManager;
use App\ImgBgLessGenerator\ImgBgLessGenerator;
use BigV\ImageCompare;

class CitizenController extends AbstractController
{
    public function index()
    {
        $this->removeUnusedImg();
        $uploadErrors = "";
        $success = false;
        if (isset($_POST['upload-name']) && isset($_FILES['photo'])) {
            $allowedExtension = [".jpg", ".png"];
            $allowedMime = "#image/(jpeg|png)#";
            $sizeLimit = 10 ** 6;
            $uploadDire = ROOTPATH . '/public/upload/';
            $img = $_FILES['photo'];
            $uploadStatus = $img['error'];
            if ($uploadStatus) {
                $uploadErrors = "Something went terribly wrong with the upload.";
            }
            $fileName = $img['name'];
            $tempName = $img['tmp_name'];
            $fileMime = mime_content_type($tempName);
            $fileMimeMatch = preg_match($allowedMime, $fileMime);
            $fileExtension = strrchr($fileName, '.');
            $fileSize = filesize($tempName);
            //analyse l'extension & le MIME
            if (!$fileMimeMatch || !in_array($fileExtension, $allowedExtension)) {
                $uploadErrors = "Error $fileName: The file should be an image. Only jpg or png formats are allowed.";
            } elseif ($fileSize > $sizeLimit) {
                $uploadErrors = "Error $fileName: The file size should less than 1Mo. File size = " . round($fileSize / $sizeLimit, 2) . "Mo.";
            }
            if (empty($uploadErrors)) {
                $newFileName = md5(uniqid("" . rand() . time(), true)) . $fileExtension;
                $success = move_uploaded_file($tempName, $uploadDire . $newFileName);

            }
        } elseif (isset($_POST['snap-form'])) {
            $img = $_POST['photo'] ?? "";
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $data = base64_decode($img);
            $newFileName = md5(uniqid("" . rand() . time(), true)) . '.png';
            $file = ROOTPATH . '/public/upload/' . $newFileName;
            $success = file_put_contents($file, $data);
        }
        if ($success) {
            $_SESSION['form-photo'] = $newFileName;
            header('Location:/citizen/denounce');
        }
        return $this->twig->render('Citizen/index.html.twig');
    }

    public function denounce()
    {
        if (!isset($_SESSION['form-photo'])||empty($_SESSION['form-photo'])) {
            header('Location:/citizen/index');
            die();
        }
        $uploadedImg = ROOTPATH . '/public/upload/'.$_SESSION['form-photo'];
        /*if (file_exists($uploadedImg)) {
            (new ImgBgLessGenerator())->createBgLessImg($uploadedImg);
        } else {
            unset($_SESSION['form-photo']);
            header('Location:/citizen/index');
        }*/
        $imgCmp = new ImageCompare();
        $maxSimilarity = 0;
        $similarImg = "";
        $witchDirPath = __DIR__ . '/../bg-less-witch/';
        $witchDir = opendir($witchDirPath);
        while (($nextElement = readdir($witchDir))){
            if ($nextElement === '.' || $nextElement === '..')
                continue;
            $witchImg = $witchDirPath.$nextElement;
            $similarity = 80 - $imgCmp->compare($uploadedImg, $witchImg);
            if ($similarity >= $maxSimilarity) {
                $maxSimilarity = $similarity;
                $similarImg = $nextElement;
            }
        }
        closedir($witchDir);

        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $witchName = $_POST['name'] ?? '';
            $address = $_POST['name'] ?? '';
            $score = $_POST['score'] ?? '';
            $image = '/upload/'.$_SESSION['form-photo'];
            $witchName= $this->cleanInput($witchName);
            if (!$witchName) {
                $errors['name'] = 'Name is required';
            }
            $address = $this->cleanInput($address);
            if (!$address) {
                $errors['address'] = 'Address is required';
            }
            if (!filter_var($score, FILTER_VALIDATE_INT) || $score<0 || $score >100)
            {
                $errors['score'] = 'Score:'.$score;
            }
            if (empty($errors)) {
                $witchManager = new WitchManager();
                $success = $witchManager->insert($witchName, $address, $score, $image);
                if ($success) {
                    unset($_SESSION['form-photo']);
                    header('Location:/');
                    die();
                }
            } else {
                var_dump($errors);
            }
        }

        $questionManager = new QuestionManager();
        $questions = $questionManager->selectQuestions();
        $answers = $questionManager->selectAnswers();
        return $this->twig->render('Citizen/denounce.html.twig', [
            'answers' => $answers,
            'questions' => $questions,
            'uploadedImg' => $_SESSION['form-photo'],
            'similarityRation' => $maxSimilarity,
            'witchImg' => $similarImg
        ]);
    }
}
