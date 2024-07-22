<?php

namespace App\Service;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;// importer la classe ParameterBagInterface
class ArtistService// Service pour la gestion du profil artiste
{
    private $parameterBag;

    public function __construct(ParameterBagInterface $parameterBag)
    {
        $this->parameterBag = $parameterBag;
    }

    public function updateArtist($form, $artist, $em)
    {// gérer la mise à jour du profil artiste (hydrater l'objet Artist)
        $artist->setNickname($form->get('nickname')->getData());
        $artist->setNumber($form->get('number')->getData());
        $categories = $form->get('category')->getData();
        foreach ($categories as $category) {
            $artist->addCategory($category);
        }
        if ($form->has('professional')) {
            $artist->setProfessional($form->get('professional')->getData());
        }
        $artist->setCity($form->get('city')->getData());
        $artist->setCountry($form->get('country')->getData());
        $artist->setPhone($form->get('phone')->getData());
        $artist->setMail($form->get('mail')->getData());
        $artist->setBio($form->get('bio')->getData());
        $artist->setBirthyear($form->get('birthyear')->getData());
        $artist->setUpdatedAt(new \DateTime());

        // Télécharger l'image
        if($form->get('image')->getData()) {
            $file = $form->get('image')->getData();
            $filename = md5(uniqid()) . '.' . $file->guessExtension();
            $uploadDir = $this->parameterBag->get('upload_dir_artist');
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $file->move($uploadDir, $filename);
            $artist->setImage($filename);
        } else {
            if($artist->getImage() == null) {
                $artist->setImage('avatar-chant.webp');
            } else {
                $artist->setImage($artist->getImage());
            }
        }
        
        $em->persist($artist);// Enregistrer les modifications
        $em->flush();// committer les changements
    }
}