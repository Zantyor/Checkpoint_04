<?php
namespace App\EventSubscriber;

use App\Entity\Project;
use App\Entity\Skills;
use App\Service\ImagesService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;

class PostImageSubscriber implements EventSubscriberInterface
{
    private $imagesService;

    public function __construct(ImagesService $imagesService)
    {
        $this->imagesService = $imagesService;
    }

    public static function getSubscribedEvents()
    {
        return array(
            'easy_admin.pre_persist' => array('postImage'),
        );
    }

    function postImage(GenericEvent $event) {
        $result = $event->getSubject();
        $method = $event->getArgument('request')->getMethod();

        /*if (! $result instanceof Skills || $method !== Request::METHOD_POST) {
            return;
        }*/

            $url = $this->imagesService->saveToDisk($result->getImg());
            $result->setImg($url);

    }
}