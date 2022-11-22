<?php
namespace App\Manager;

use Intervention\Image\ImageManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class PokemonManager{

    protected $imageManager;
    protected $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->imageManager = new ImageManager(["driver" => "gd"]);
        $this->mailer = $mailer;
    }

    public function uploadImage(UploadedFile $image, $target){
        $filename = uniqid().".".$image -> guessExtension();
        if (!is_dir($target)) {
            mkdir($target, 0777);
        }
        $image -> move($target, $filename);

        // Aquí la imagen está subida en $target/$filename
        $this->imageManager->make("$target/$filename")->greyscale()->insert($target."/upgrade.png")->save("$target/$filename");

        return $filename;
    }

    public function sendMail($pokemonName) {
        $email = (new Email())
            ->from('moycarretero@gmail.com')
            ->to('akatbach.fati@gmail.com')
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Pokemon nuevo!!!')
            ->text("Se ha creado el pokemon $pokemonName!!!!")
            ->html('<p>See Twig integration for better HTML integration!</p>');

        $this->mailer->send($email);

        // localhost/user/tk/x472wvsavasd
    }
}
