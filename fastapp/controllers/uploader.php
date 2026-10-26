<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed dc ');

class Uploader extends MY_Controller {

    public $publicAccess = array('index');

    public function __construct() {

        parent::__construct();
    }

    /**
     * 
     * add detail
     */
    public function index() {
        $targetFolder = 'uploads/'.NODE.'/'; // Relative to the root
        $targetPath = ROOTPATH . $targetFolder;
         if (!is_dir($targetPath)) {
            if (!mkdir($targetPath, 0777, true)) { // Create folder with read/write/execute permissions for all users
                echo json_encode(['status' => 'error', 'message' => 'Failed to create directory.']);
                exit;
            }
        }
          // Proceed if files are uploaded
        if (!empty($_FILES)) {
            $tempFile = $_FILES['Filedata']['tmp_name']; // Temporary file
            $generatedFileName = uniqid(time() . '_') . strstr($_FILES['Filedata']['name'], '.'); // Generate unique filename
            $targetFile = rtrim($targetPath, '/') . '/' . $generatedFileName; // Full target file path

            // Validate file type
            $fileTypes = array('jpg', 'jpeg', 'gif', 'png'); // Allowed file extensions
            $fileParts = pathinfo($_FILES['Filedata']['name']); // Get file extension

            // MIME type check for added security
            $mimeType = mime_content_type($tempFile);
            $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];

            // Check if file type is valid
            if (in_array(strtolower($fileParts['extension']), $fileTypes) && in_array($mimeType, $allowedMimeTypes)) {
                // Move the uploaded file to the target folder
                if (move_uploaded_file($tempFile, $targetFile)) {
                    // Respond with the generated filename in JSON format
                    echo $generatedFileName;
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Error uploading file.']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Invalid file type.']);
            }
        } else {
            show_404(); // No file uploaded, show 404
        }
    }
}


