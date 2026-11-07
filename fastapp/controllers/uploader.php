<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed dc ');

class Uploader extends MY_Controller {

    public $publicAccess = array('index');

    public function __construct() {
        parent::__construct();
    }

    /**
     * add detail
     */
    public function index() {
        $node = defined('NODE') ? NODE : 'node';
        $targetFolder = 'uploads/' . $node . '/'; // Relative to the root
        $targetPath = defined('ROOTPATH') ? (ROOTPATH . $targetFolder) : (FCPATH . $targetFolder);

        if (!is_dir($targetPath)) {
            if (!mkdir($targetPath, 0777, true)) {
                echo json_encode(array('status' => 'error', 'message' => 'Failed to create directory.'));
                exit;
            }
        }

        // Proceed if files are uploaded
        if (!empty($_FILES)) {
            // Pick file from 'Filedata', 'file', or first available $_FILES entry
            $fileData = null;
            if (isset($_FILES['Filedata'])) {
                $fileData = $_FILES['Filedata'];
            } elseif (isset($_FILES['file'])) {
                $fileData = $_FILES['file'];
            } else {
                $fileData = reset($_FILES);
            }

            if (empty($fileData) || empty($fileData['tmp_name'])) {
                echo json_encode(array('status' => 'error', 'message' => 'No file received.'));
                exit;
            }

            $tempFile = $fileData['tmp_name'];
            $fileParts = pathinfo($fileData['name']);
            $fileExt = strtolower(isset($fileParts['extension']) ? $fileParts['extension'] : '');

            // Allowed extensions
            $allowedExtensions = array('jpg', 'jpeg', 'gif', 'png', 'webp', 'bmp');

            // Allowed MIME types
            $allowedMimeTypes = array(
                'image/jpeg', 'image/pjpeg', 'image/png', 'image/x-png',
                'image/gif', 'image/webp', 'image/bmp', 'image/x-ms-bmp',
                'application/octet-stream'
            );

            $mimeType = function_exists('mime_content_type') && file_exists($tempFile) ? mime_content_type($tempFile) : 'image/' . $fileExt;

            if (in_array($fileExt, $allowedExtensions) && (in_array($mimeType, $allowedMimeTypes) || empty($mimeType))) {
                $generatedFileName = uniqid(time() . '_') . '.' . $fileExt;
                $targetFile = rtrim($targetPath, '/\\') . DIRECTORY_SEPARATOR . $generatedFileName;

                if (move_uploaded_file($tempFile, $targetFile)) {
                    $fileUrl = base_url() . $targetFolder . $generatedFileName;

                    $isAjax = (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') 
                           || (isset($_REQUEST['format']) && $_REQUEST['format'] === 'json')
                           || (isset($_SERVER['HTTP_ACCEPT']) && strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false);

                    if ($isAjax) {
                        header('Content-Type: application/json');
                        echo json_encode(array(
                            'status' => 'success',
                            'filename' => $generatedFileName,
                            'url' => $fileUrl
                        ));
                    } else {
                        // Plain text filename for legacy callers
                        echo $generatedFileName;
                    }
                } else {
                    echo json_encode(array('status' => 'error', 'message' => 'Error uploading file.'));
                }
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'Invalid file type: ' . $fileExt));
            }
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'No file uploaded.'));
        }
    }
}
