<?php

namespace App\Traits;

trait CaptchaGenerator
{
    public function generateCaptcha($width = 115, $height = 35, $fontPath = null)
    {
        $captchaText = $this->generateRandomCaptchaText();
        $image = imagecreatetruecolor($width, $height);
        $backgroundColor = imagecolorallocate($image, 255, 255, 255);
        $fontColor = imagecolorallocate($image, 0, 0, 0);
        imagefilledrectangle($image, 0, 0, $width, $height, $backgroundColor);
        $this->addNoise($image, $width, $height);
        $fontPath = $fontPath ?? public_path('font/arial.ttf');
        if (file_exists($fontPath)) {
            imagettftext($image, 20, 0, $width / 4, $height / 1.5, $fontColor, $fontPath, $captchaText);
        } else {
            imagestring($image, 5, $width / 4, $height / 4, $captchaText, $fontColor);
        }
        $this->applyDistortion($image, $width, $height);
        ob_start();
        imagepng($image);
        $imageData = ob_get_clean();
        imagedestroy($image);
        session()->put('captchaText', $captchaText);
        return response($imageData, 200, ['Content-Type' => 'image/png', 'Cache-Control' => 'no-store, no-cache, private, max-age=0', 'Pragma' => 'no-cache',]);
    }
    protected function generateRandomCaptchaText($length = 6)
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $charactersLength = strlen($characters);
        $captchaText = '';
        for ($i = 0; $i < $length; $i++) {
            $captchaText .= $characters[rand(0, $charactersLength - 1)];
        }
        return $captchaText;
    }
    protected function addNoise($image, $width, $height)
    {
        $gray = imagecolorallocate($image, 50, 50, 50);
        for ($i = 0; $i < 100; $i++) {
            imagesetpixel($image, rand(0, $width), rand(0, $height), $gray);
        }
    }
    protected function applyDistortion($image, $width, $height)
    {
        // Add basic distortion by drawing random lines
        $lineColor = imagecolorallocate($image, 150, 150, 150);
        for ($i = 0; $i < 5; $i++) {
            imageline($image, rand(0, $width), rand(0, $height), rand(0, $width), rand(0, $height), $lineColor);
        }
    }
}
