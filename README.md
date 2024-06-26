# Coryphée platform

## Description

This project is a platform for promote musicians.
This project is a project for my Training CDA.

The technologies used are:
- Symfony 7
- Bootstrap 5
- Twig
- MySQL

## Packages installation

- Features to verify email addresses
```sh
composer require symfonycasts/verify-email-bundle
```

- Features to limit the rate of calls to certain parts of the application.
```sh
composer require symfony/rate-limiter
```

- locking features for resource management
```sh
composer require symfony/lock 
```

- Provide fake data to test the database mapping
```shell
composer require --dev orm-fixtures
php bin/console doctrine:fixtures:load
```

- Dashboard Admin
```shell
composer require easycorp/easyadmin-bundle
```

- Password hashing on demand
```shell
symfony console security:hash-password
```

- Pagination
```shell
composer require knplabs/knp-paginator-bundle
```

- Reset Password
```shell
composer require symfonycasts/reset-password-bundle
bin/console make:reset-password
```

## Entities

### User

This entity represents a user of the platform. The user can be an artist's manager, a producer or an individual. They are defined by the `role` property.

| Property          | Type      | Description          | Relation |
|-------------------|-----------|----------------------|----------|
| email             | string    | 180 NOT NULL, UNIQUE |          |
| roles             | string    | 50 NOT NULL          |          |
| password          | string    | 255 NOT NULL         |          |
| image             | string    | 255                  |          |
| name              | string    | 50                   |          |
| corporateName     | string    | 100                  |          |
| siret             | string    | 17                   |          |
| phone             | string    | 20                   |          |
| address           | string    | 50                   |          |
| additionalAddress | string    | 50                   |          |
| city              | string    | 50                   |          |
| zip               | string    | 5                    |          |
| country           | string    | 50                   |          |
| consent           | boolean   |                      |          |
| created_at        | datetime  |                      |          |
| updated_at        | datetime  |                      |          |
| artists           | OneToMany | OrphanTrue           | Artist   |
| favorites         | OneToMany |                      | Favorite |
| reviews           | OneToMany |                      | Review   |

---

### Artist

This entity represents an artist.

| Property      | Type       | Description          | Relation      |
|---------------|------------|----------------------|---------------|
| nickname      | string     | 50 NOT NULL          |               |
| number        | integer    | NOT NULL             |               |
| professional  | bool       | NOT NULL             |               |
| city          | string     | 50                   |               |
| country       | string     | 50                   |               |
| phone         | string     | 20 NOT NULL          |               |
| mail          | string     | 180 NOT NULL         |               |
| image         | string     | 255                  |               |
| bio           | text       |                      |               |
| birthyear     | integer    |                      |               |
| created_at    | datetime   | NOT NULL             |               |
| updated_at    | datetime   |                      |               |
| musician      | ManyToOne  | NOT NULL, OrphanTrue | User          |
| category      | ManyToMany | NOT NULL             | Category      |
| tag           | ManyToMany |                      | Tag           |
| favorite      | ManyToMany |                      | Favorite      |
| musicalStyle  | ManyToMany | NOT NULL             | MusicalStyle  |
| instrument    | ManyToMany | NOT NULL             | Instrument    |
| ensemble      | ManyToMany |                      | Set           |
| performance   | ManyToMany |                      | Performance   |
| pictures      | OneToMany  |                      | Picture       |
| videos        | OneToMany  |                      | Video         |
| audios        | OneToMany  |                      | Audio         |
| websites      | OneToMany  |                      | Website       |
| socialNetwork | ManyToMany |                      | SocialNetwork |
| musicPlatform | ManyToMany |                      | MusicPlatform |
| eventPlatform | ManyToMany |                      | EventPlatform |
| reviews       | OneToMany  |                      | Review        |
| events        | ManyToMany |                      | Event         |

---

### Review

This entity represents a review made by a producer to an artist.


| Property | Type      | Description | Relation |
|----------|-----------|-------------|----------|
| title    | string    | 50 NOT NULL |          |
| comment  | text      |             |          |
| rating   | integer   | NOT NULL    |          |
| user     | ManyToOne | NOT NULL    | User     |
| artist   | ManyToOne | NOT NULL    | Artist   |

---

### Event

This entity represents an event in which an artist participates.

| Property    | Type       | Description  | Relation |
|-------------|------------|--------------|----------|
| location    | string     | 50 NOT NULL  |          |
| title       | string     | 50 NOT NULL  |          |
| date        | datetime   |              |          |
| description | text       |              |          |
| address     | string     | 50           |
| city        | string     | 50           |          |
| zip         | string     | 5            |          |
| country     | string     | 50           |          |
| image       | string     | 255 NOT NULL |          |
| link        | string     | 255          |          |
| created_at  | datetime   | NOT NULL     |          |
| updated_at  | datetime   |              |          |
| artists     | ManyToMany |              | Artist   |


---

### Category

This entity represents the category of the artists.

| Property    | Type       | Description  | Relation |
|-------------|------------|--------------|----------|
| name        | string     | 50 NOT NULL  |          |
| image       | string     | 255 NOT NULL |          |
| description | string     | 255          |          |
| artists     | ManyToMany | NOT NULL     | Artist   |

---

### Tag
This entity represents a tag that links to a selection of artists.

| Property | Type       | Description | Relation |
|----------|------------|-------------|----------|
| name     | string     | 50 NOT NULL |          |
| artists  | ManyToMany |             | Artist   |

---

### Performance

This entity represents the performance of an artist.

| Property | Type       | Description | Relation |
|----------|------------|-------------|----------|
| type     | string     | 30 NOT NULL |          |
| location | string     | 50          |          |
| artists  | ManyToMany |             | Artist   |

---

### Set

This entity represents the set of an artist.

| Property | Type       | Description | Relation |
|----------|------------|-------------|----------|
| name     | string     | 50 NOT NULL |          |
| artists  | ManyToMany |             | Artist   |

---

### MusicalStyle

This entity represents the musical style of an artist.

| Property | Type       | Description | Relation |
|----------|------------|-------------|----------|
| name     | string     | 50 NOT NULL |          |
| artists  | ManyToMany |             | Artist   |

---

### Instrument

This entity represents the instrument of an artist.

| Property | Type       | Description | Relation |
|----------|------------|-------------|----------|
| name     | string     | 50 NOT NULL |          |
| artists  | ManyToMany |             | Artist   |

---

### Favorite

This entity represents the favorite of an artist and a user.

| Property | Type       | Description | Relation |
|----------|------------|-------------|----------|
| user     | ManyToOne  | NOT NULL    | User     |
| artists  | ManyToMany | NOT NULL    | Artist   |

---

### Audio

This entity represents the audio style of an artist.

| Property | Type      | Description  | Relation |
|----------|-----------|--------------|----------|
| name     | string    | 50 NOT NULL  |          |
| link     | string    | 255 NOT NULL |          |
| artists  | ManyToOne |              | Artist   |

---

### Picture

This entity represents the picture style of an artist.

| Property | Type      | Description  | Relation |
|----------|-----------|--------------|----------|
| name     | string    | 50 NOT NULL  |          |
| link     | string    | 255 NOT NULL |          |
| artists  | ManyToOne |              | Artist   |

---

### Video

This entity represents the video of an artist.

| Property | Type      | Description  | Relation |
|----------|-----------|--------------|----------|
| name     | string    | 50 NOT NULL  |          |
| link     | string    | 255 NOT NULL |          |
| artists  | ManyToOne |              | Artist   |

---

### EventPlatform

This entity represents the event platform of an artist.

| Property | Type       | Description  | Relation |
|----------|------------|--------------|----------|
| name     | string     | 30 NOT NULL  |          |
| link     | string     | 255 NOT NULL |          |
| artists  | ManyToMany |              | Artist   |

---

### MusicPlatform

This entity represents the music platform of an artist.

| Property | Type       | Description  | Relation |
|----------|------------|--------------|----------|
| name     | string     | 50 NOT NULL  |          |
| link     | string     | 255 NOT NULL |          |
| artists  | ManyToMany |              | Artist   |

---

### SocialNetwork

This entity represents the social network of an artist.

| Property | Type       | Description  | Relation |
|----------|------------|--------------|----------|
| name     | string     | 50 NOT NULL  |          |
| link     | string     | 255 NOT NULL |          |
| artists  | ManyToMany |              | Artist   |

---

### Website

This entity represents the website of an artist.

| Property | Type      | Description  | Relation |
|----------|-----------|--------------|----------|
| name     | string    | 50 NOT NULL  |          |
| link     | string    | 255 NOT NULL |          |
| artists  | ManyToOne |              | Artist   |

---


## Pages architecture

-- home
-- all artists
-- artist
-- new artist
-- edit artist
-- my artists
-- my favorite
-- my reviews
-- login
-- register
-- account
