<?php

namespace App\Service;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;// importer la classe ParameterBagInterface
class ProfileService// Service pour la gestion du profil utilisateur
{
    private $parameterBag;

    public function __construct(ParameterBagInterface $parameterBag)
    {
        $this->parameterBag = $parameterBag;
    }

    public function updateProfile($form, $user, $em)// mise à jour du profil utilisateur
    {// gérer la mise à jour du profil utilisateur(hydrater l'objet User)
        $user->setname($form->get('name')->getData());
        $user->setCorporateName($form->get('corporateName')->getData());
        $user->setSiret($form->get('siret')->getData());
        $user->setPhone($form->get('phone')->getData());
        $user->setAddress($form->get('address')->getData());
        $user->setAdditionalAddress($form->get('additionalAddress')->getData());
        $user->setCity($form->get('city')->getData());
        $user->setZip($form->get('zip')->getData());
        $user->setCountry($form->get('country')->getData());
        $user->setUpdatedAt(new \DateTime());

        // Télécharger l'image
        if($form->get('image')->getData()) {
            $file = $form->get('image')->getData();
            $filename = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move($this->parameterBag->get('upload_dir_user'), $filename);
            $user->setImage($filename);
        } else {
            if($user->getImage() == null) {
                $user->setImage('default.png');
            } else {
                $user->setImage($user->getImage());
            }
        }
        
        $em->persist($user);// Enregistrer les modifications
        $em->flush();// committer les changements
    }
}