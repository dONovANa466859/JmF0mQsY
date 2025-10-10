<?php
// 代码生成时间: 2025-10-11 03:57:28
class WatermarkGenerator {
    
    /**
     * Add watermark to an image file.
     *
     * @param string $imagePath Path to the image file.
     * @param string $watermarkText The text to be used as the watermark.
     * @param string $outputPath Path to save the watermarked image.
     * @return bool Returns true on success, false on failure.
     */
    public function addWatermark($imagePath, $watermarkText, $outputPath) {
        try {
            // Check if the image file exists
            if (!file_exists($imagePath)) {
                throw new Exception("Image file not found: {$imagePath}");
            }

            // Load the image resource
            $image = $this->loadImage($imagePath);
            if (!$image) {
                throw new Exception("Failed to load image: {$imagePath}");
            }

            // Create a new image resource with alpha blending for watermark
            $watermarkImage = imagecreatetruecolor(imagesx($image), imagesy($image));
            imagealphablending($watermarkImage, true);

            // Add the watermark text
            $fontPath = 'path/to/your/font.ttf'; // Specify the path to the font file
            $fontSize = 20;
            $textColor = imagecolorallocatealpha($watermarkImage, 0, 0, 0, 50); // 50% transparent black
            imagettftext(
                $watermarkImage,
                $fontSize,
                0,
                (imagesx($image) - $fontSize * 3),
                (imagesy($image) - $fontSize),
                $textColor,
                $fontPath,
                $watermarkText
            );

            // Merge the watermark with the original image
            imagecopymerge($image, $watermarkImage, 0, 0, 0, 0, imagesx($watermarkImage), imagesy($watermarkImage), 100, 100);

            // Save the watermarked image
            switch (strtolower(pathinfo($imagePath, PATHINFO_EXTENSION))) {
                case 'jpeg':
                case 'jpg':
                    imagejpeg($image, $outputPath);
                    break;
                case 'png':
                    imagepng($image, $outputPath);
                    break;
                case 'gif':
                    imagegif($image, $outputPath);
                    break;
                default:
                    throw new Exception("Unsupported image format");
            }

            // Free up memory
            imagedestroy($image);
            imagedestroy($watermarkImage);

            return true;
        } catch (Exception $e) {
            // Handle any errors
            error_log($e->getMessage());
            return false;
        }
    }

    /**
     * Load an image resource from a file path.
     *
     * @param string $imagePath Path to the image file.
     * @return resource|false Returns the image resource on success, false on failure.
     */
    private function loadImage($imagePath) {
        $imageInfo = getimagesize($imagePath);
        $imageType = $imageInfo[2];

        if ($imageType === IMAGETYPE_JPEG) {
            return imagecreatefromjpeg($imagePath);
        } elseif ($imageType === IMAGETYPE_GIF) {
            return imagecreatefromgif($imagePath);
        } elseif ($imageType === IMAGETYPE_PNG) {
            return imagecreatefrompng($imagePath);
        } else {
            return false;
        }
    }
}

// Usage example
try {
    $watermarkGenerator = new WatermarkGenerator();
    $imagePath = 'path/to/your/image.jpg';
    $watermarkText = 'Your Watermark';
    $outputPath = 'path/to/save/watermarked_image.jpg';
    if ($watermarkGenerator->addWatermark($imagePath, $watermarkText, $outputPath)) {
        echo "Watermark added successfully!
";
    } else {
        echo "Failed to add watermark.
";
    }
} catch (Exception $e) {
    // Handle any exceptions
    echo "Error: " . $e->getMessage() . "
";
}