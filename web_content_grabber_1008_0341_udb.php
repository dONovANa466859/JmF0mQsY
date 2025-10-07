<?php
// 代码生成时间: 2025-10-08 03:41:23
class WebContentGrabber {

    /**
     * Fetches content from a given URL.
     *
     * @param string $url The URL to fetch content from.
     * @return string|null The fetched content or null on failure.
     */
    public function fetchContent($url) {
        try {
            // Validate the URL
            if (!filter_var($url, FILTER_VALIDATE_URL)) {
                throw new Exception('Invalid URL provided.');
            }

            // Initialize a cURL session
            $ch = curl_init($url);

            // Set cURL options
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Web Content Grabber');

            // Execute the cURL session and fetch the content
            $content = curl_exec($ch);

            // Check for cURL errors
            if (curl_errno($ch)) {
                throw new Exception(curl_error($ch));
            }

            // Close the cURL session
            curl_close($ch);

            // Return the fetched content
            return $content;

        } catch (Exception $e) {
            // Handle exceptions and return null on failure
            error_log($e->getMessage());
            return null;
        }
    }

    /**
     * Saves the fetched content to a file.
     *
     * @param string $content The content to save.
     * @param string $filePath The file path to save the content to.
     * @return bool True on success, false on failure.
     */
    public function saveContentToFile($content, $filePath) {
        try {
            // Check if the content is not empty
            if (empty($content)) {
                throw new Exception('Content to save is empty.');
            }

            // Save the content to a file
            if (file_put_contents($filePath, $content) === false) {
                throw new Exception('Failed to save content to file.');
            }

            // Return true on success
            return true;

        } catch (Exception $e) {
            // Handle exceptions and return false on failure
            error_log($e->getMessage());
            return false;
        }
    }
}

// Example usage
$grabber = new WebContentGrabber();
$url = 'https://example.com';
$filePath = '/path/to/save/content.html';

$content = $grabber->fetchContent($url);
if ($content !== null) {
    $grabber->saveContentToFile($content, $filePath);
}
