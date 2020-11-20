<?php

namespace App\Controller;

use App\Model\WitchManager;

class CitizenController extends AbstractController
{
    public function index()
    {
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
        $witchManager = new WitchManager();
        $questions = $witchManager->selectQuestions();
        $answers = $witchManager->selectAnswers();
        return $this->twig->render('Citizen/denounce.html.twig', [
            'answers' => $answers,
            'questions' => $questions
        ]);
    }
}
