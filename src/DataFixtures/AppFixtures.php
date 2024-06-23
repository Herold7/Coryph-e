<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Set;
use App\Entity\Tag;
use App\Entity\User;
use App\Entity\Audio;
use App\Entity\Event;
use App\Entity\Video;
use App\Entity\Artist;
use App\Entity\Review;
use App\Entity\Picture;
use App\Entity\Website;
use App\Entity\Category;
use App\Entity\Favorite;
use App\Entity\Instrument;
use App\Entity\Performance;
use App\Entity\MusicalStyle;
use App\Entity\EventPlatform;
use App\Entity\MusicPlatform;
use App\Entity\SocialNetwork;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        // Création d'un admin
        $admin = new User();
        $admin->setEmail('admin@admin.fr')
            ->setRoles(['ROLE_ADMIN'])
            ->setPassword('$2y$13$J2O4AgxFCpLTNwGXj.1nQe.QrGnaq/UCkF0OeJ84chNbknf85Ox7O')
            ->setName('Herold')
            ->setCorporateName($faker->company)
            ->setSiret($faker->siret)
            ->setPhone($faker->phoneNumber)
            ->setAddress($faker->streetAddress)
            ->setAdditionalAddress($faker->secondaryAddress)
            ->setCity($faker->city)
            ->setZip($faker->postcode)
            ->setCountry('FR');
        $manager->persist($admin);

        // Création d'un musicien
        $musicians = [];
        for ($i = 0; $i < 10; $i++) {
            $name = $faker->firstName();
            $musician = new User();
            $musician->setName($name)
                ->setEmail($name . '@' . $faker->freeEmailDomain())
                ->setRoles(['ROLE_MUSICIAN'])
                ->setPassword('$2y$13$J2O4AgxFCpLTNwGXj.1nQe.QrGnaq/UCkF0OeJ84chNbknf85Ox7O')
                ->setImage('artist.webp')
                ->setCorporateName($faker->company)
                ->setSiret($faker->siret)
                ->setPhone($faker->phoneNumber)
                ->setAddress($faker->streetAddress)
                ->setAdditionalAddress($faker->secondaryAddress)
                ->setCity($faker->city)
                ->setZip($faker->postcode)
                ->setCountry('FR')
                ->setConsent($faker->boolean)
                ->setCreatedAt($faker->dateTimeThisYear);
            $manager->persist($musician);
            array_push($musicians, $musician);
        }

        // Création de categories
        $categories = ['chanteur', 'musicien', 'groupe'];
        $categoryArray = [];
        for ($i = 0; $i < count($categories); $i++) {
            $category = new Category();
            $category->setName($categories[$i])
                ->setImage(rand(0, 1) ? 'background-chant.webp' : 'background-groupe.webp')
                ->setDescription($faker->text);
            $manager->persist($category);
            array_push($categoryArray, $category);
        }

        // Création d'instruments
        $instruments = ['piano', 'guitare', 'basse', 'batterie', 'saxophone', 'trompette', 'violon'];
        $instrumentArray = [];
        for ($i = 0; $i < count($instruments); $i++) {
            $instrument = new Instrument();
            $instrument->setName($instruments[$i]);
            $manager->persist($instrument);
            array_push($instrumentArray, $instrument);
        }

        // ajout de style de musique
        $musicalStyles = ['jazz', 'rock', 'pop', 'classique', 'reggae', 'blues', 'soul'];
        $musicalStyleArray = [];
        for ($i = 0; $i < count($musicalStyles); $i++) {
            $musicalStyle = new MusicalStyle();
            $musicalStyle->setName($musicalStyles[$i]);
            $manager->persist($musicalStyle);
            array_push($musicalStyleArray, $musicalStyle);
        }
        // Création de type de performance
        $performances = ['concert', 'mariage', 'bal', 'festival', 'soirée privée', 'bat-mitzva', 'funerailles'];
        $performanceArray = [];
        for ($i = 0; $i < count($performances); $i++) {
            $performance = new Performance();
            $performance->setType($performances[$i])
                ->setLocation($faker->region());
            $manager->persist($performance);
            array_push($performanceArray, $performance);
        }

        // Création d'un ensemble
        $sets = ['duo', 'trio', 'quatuor', 'quintet', 'sextet', 'big-band'];
        $setArray = [];
        for ($i = 0; $i < count($sets); $i++) {
            $set = new Set();
            $set->setName($sets[$i]);
            $manager->persist($set);
            array_push($setArray, $set);
        }

        // ajout de plateforme Musicale
        $musicPlatforms = ['spotify', 'deezer', 'apple music', 'amazon music', 'youtube music', 'soundcloud', 'bandcamp'];
        $musicPlatformArray = [];
        for ($i = 0; $i < count($musicPlatforms); $i++) {
            $musicPlatform = new MusicPlatform();
            $musicPlatform->setName($musicPlatforms[$i])
                ->setLink($faker->url);
            $manager->persist($musicPlatform);
            array_push($musicPlatformArray, $musicPlatform);

            // ajout de plateforme evenementiel
            $eventPlatforms = ['evenementielpourtous', 'linkaband', 'mariage.com', 'mariage.net', 'zankyou', 'acteurfête'];
            $eventPlatformArray = [];
            for ($i = 0; $i < count($eventPlatforms); $i++) {
                $eventPlatform = new EventPlatform();
                $eventPlatform->setName($eventPlatforms[$i])
                    ->setLink($faker->url);
                $manager->persist($eventPlatform);
                array_push($eventPlatformArray, $eventPlatform);
            }

            // ajout de réseau sociaux
            $socialNetworks = ['facebook', 'instagram', 'twitter', 'linkedin', 'pinterest', 'tiktok', 'snapchat'];
            for ($i = 0; $i < count($socialNetworks); $i++) {
            $socialNetworkArray = [];
            $socialNetwork = new SocialNetwork();
            $socialNetwork->setName($socialNetworks[$i])
                ->setLink($faker->url);
            $manager->persist($socialNetwork);
            array_push($socialNetworkArray, $socialNetwork);
            }

            // Création d'un artist
            for ($i = 0; $i < 50; $i++) {
                $name = $faker->firstname();
                $artist = new Artist();
                $artist->setNickname($name)
                    ->setNumber(in_array($categoryArray, [0, 1]) ? 1 : $faker->numberBetween(2, 50))
                    ->setProfessional($faker->boolean)
                    ->setCity($faker->city)
                    ->setCountry('FR')
                    ->setPhone($faker->phoneNumber)
                    ->setMail($name . '@' . $faker->freeEmailDomain())
                    ->setImage(rand(0, 1) ? 'avatar-chant.webp' : 'avatar-groupe.webp')
                    ->setBio($faker->text)
                    ->setBirthyear($faker->year)
                    ->setCreatedAt($faker->dateTimeThisYear)
                    ->setUser($faker->randomElement($musicians))
                    ->setCategory($faker->randomElement($categoryArray))
                    ->addInstrument($faker->randomElement($instrumentArray))
                    ->addEnsemble($faker->randomElement($setArray))
                    ->addMusicalStyle($faker->randomElement($musicalStyleArray))
                    ->addPerformance($faker->randomElement($performanceArray))
                    ->addEnsemble($faker->randomElement($setArray))
                    ->addSocialNetwork($faker->randomElement($socialNetworkArray))
                    ->addMusicPlatform($faker->randomElement($musicPlatformArray))
                    ->addEventPlatform($faker->randomElement($eventPlatformArray));

                // Ajout de users avec favoris
                if ($i > 30) {
                    $user = new User();
                    $user->setEmail($name . '@' . $faker->freeEmailDomain())
                        ->setRoles(['ROLE_USER'])
                        ->setPassword('$2y$13$J2O4AgxFCpLTNwGXj.1nQe.QrGnaq/UCkF0OeJ84chNbknf85Ox7O')
                        ->setImage(rand(0, 1) ? 'avatar-particulier.webp' : 'avatar-producteur.webp')
                        ->setName($faker->firstname)
                        ->setCorporateName($faker->company)
                        ->setSiret($faker->siret)
                        ->setPhone($faker->phoneNumber)
                        ->setAddress($faker->streetAddress)
                        ->setAdditionalAddress($faker->secondaryAddress)
                        ->setCity($faker->city)
                        ->setZip($faker->postcode)
                        ->setCountry('FR')
                        ->setConsent($faker->boolean)
                        ->setCreatedAt($faker->dateTimeThisYear);
                    $manager->persist($user);

                    // Add favorites to users
                    $favorite = new Favorite();
                    $favorite->setUser($user)
                        ->addArtist($artist);
                    $manager->persist($favorite);

                    // Création d'un tag
                    $tag = new Tag();
                    
                    $tag->setName($faker->word)
                        ->addArtist($artist);
                    $manager->persist($tag);

                    // ajout review
                    $review = new Review();
                    $review->setTitle($faker->sentence(3))
                        ->setComment($faker->text)
                        ->setRating($faker->numberBetween(1, 5))
                        ->setUser($user)
                        ->setArtist($artist);
                    $manager->persist($review);

                    // ajout Event
                    $event = new Event();
                    $eventDate = $faker->dateTimeThisYear('-4 months');
                    $event->setLocation($faker->company)
                        ->setTitle($faker->sentence(3))
                        ->setDate($faker->dateTimeThisYear)
                        ->setDescription($faker->paragraph(3))
                        ->setAddress($faker->streetAddress)
                        ->setCity($faker->city)
                        ->setZip($faker->postcode)
                        ->setCountry('FR')
                        ->setImage('cover-event.webp')
                        ->setLink($faker->url)
                        ->setCreatedAt($eventDate);
                    $manager->persist($event);

                    // Création d'un audio
                    $audio = new Audio();
                    $audio->setName($faker->sentence(3))
                        ->setLink($faker->url)
                        ->setArtist($artist);
                    $manager->persist($audio);

                    // ajout d'image
                    $picture = new Picture();
                    $picture->setName($faker->sentence(3))
                        ->setLink($faker->url)
                        ->setArtist($artist);
                    $manager->persist($picture);

                    // ajout de vidéo
                    $video = new Video();
                    $video->setName($faker->sentence(3))
                        ->setLink($faker->url)
                        ->setArtist($artist);
                    $manager->persist($video);

                    // ajout de site internet
                    $website = new Website();
                    $website->setName($faker->sentence(3))
                        ->setLink($faker->url)
                        ->setArtist($artist);
                    $manager->persist($website);
                }
                $manager->persist($artist);
            }
            $manager->flush();
        }
    }
}
