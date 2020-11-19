<?php

namespace App\Controller;

class CitizenController extends AbstractController
{
    public function index()
    {
        $uploadErrors = [];
        if (isset($_POST['upload-name']) && isset($_FILES['photo'])) {
            $allowedExtension = [".jpg", ".png"];
            $allowedMime = "#image/(jpeg|png)#";
            $sizeLimit = 10**6;
            $uploadDire = ROOTPATH.'/public/upload/';
            $img = $_FILES['photo'];
            $uploadStatus = $img['error']; //1 == error
            if ($uploadStatus) {
                $uploadErrors["status"] = "Something went terribly wrong with the upload.";
            }
            $fileName = $img['name'];
            $tempName = $img['tmp_name'];
            $fileMime = mime_content_type($tempName);
            $fileMimeMatch = preg_match($allowedMime, $fileMime);
            $fileExtension = strrchr($fileName, '.');
            $fileSize = filesize($tempName);
            //analyse l'extension & le MIME
            if (!$fileMimeMatch || !in_array($fileExtension, $allowedExtension)) {
                $uploadErrors[$fileName] = "Error $fileName: The file should be an image. Only jpg, png formats are allowed.";
            } elseif ($fileSize > $sizeLimit) {
                $uploadErrors[$fileName] = "Error $fileName: The file size should less than 1Mo. File size = ".round($fileSize/$sizeLimit, 2)."Mo.";
            }
            if (!isset($uploadErrors[$fileName])) {
                $hashId = md5(uniqid( "".rand().time(), true));
                move_uploaded_file($tempName, $uploadDire.$hashId.$fileExtension);
            }
            var_dump($uploadErrors);
        } elseif (isset($_POST['snap-form'])) {
            $img = $_POST['photo'] ?? "";
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $data = base64_decode($img);
            $fileName = md5(uniqid("" . rand() . time(), true)) . '.png';
            $file = ROOTPATH . '/public/upload/' . $fileName;
            $success = file_put_contents($file, $data);
            var_dump($success);
        }
        return $this->twig->render('Citizen/index.html.twig');
    }
}
