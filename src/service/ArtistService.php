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

    public function createArtist($form, $artist, $em)
    {// gérer la mise à jour du profil artiste (hydrater l'objet Artist)
        $artist->setNickname($form->get('nickname')->getData());
        $artist->setNumber($form->get('number')->getData());
        $artist->setProfessional($form->get('professional')->getData());
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
            $file->move($this->parameterBag->get('upload_dir_artist'), $filename);
            $artist->setImage($filename);
        } else {
            if($artist->getImage() == null) {
                $artist->setImage('avatar-chant.webp');
            } else {
                $artist->setImage($artist->getImage());
            }
        }

        // Definir les category
        if($form->get('category')->getData() == 'chanteur') {
            $artist->setCategory(['singer']);
        } elseif ($form->get('category')->getData() == 'musicien') {
            $artist->setCategory(['musician']);
        } else {
            $artist->setCategory(['group']);
        };
        
        $em->persist($artist);// Enregistrer les modifications
        $em->flush();// committer les changements
    }
}