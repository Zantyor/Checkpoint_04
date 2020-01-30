<?php
namespace App\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpKernel\KernelInterface;

class ImagesService
{
    private $kernel;
    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    function saveToDisk($tmpUrl) {
        $uploadDirectory = 'build/images/';
        $path = $this->kernel->getProjectDir().'/public/' . $uploadDirectory;
        $imageName = uniqid().'.png'; //. '.' . $image->guessExtension();
//        $image->move($path, $imageName);
        move_uploaded_file($tmpUrl, $path . $imageName);
        return '/'. $uploadDirectory . $imageName;
    }
}