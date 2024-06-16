# BnB platform

## Description

This project is a platform for promote musicians.
This project is a project for my Training CDA.

The technologies used are:
- Symfony 7
- Bootstrap 5
- Twig
- MySQL

## Entities

### User

This entity represents a user of the platform. The user can be an artist's manager, a producer or an individual. They are defined by the `role` property.

| Property          | Type       | Description          | Relation |
|-------------------|------------|----------------------|----------|
| email             | string     | 180 NOT NULL, UNIQUE |          |
| roles             | string     | 50 NOT NULL          |          |
| password          | string     | 255 NOT NULL         |          |
| image             | string     | 255                  |          |
| name              | string     | 30                   |          |
| corporateName     | string     | 100                  |          |
| siret             | string     | 14                   |          |
| phone             | string     | 15                   |          |
| address           | string     | 50                   |          |
| additionalAddress | string     | 50                   |          |
| city              | string     | 50                   |          |
| zip               | string     | 5                    |          |
| country           | string     | 50                   |          |
| consent           | boolean    |                      |          |
| created_at        | datetime   |                      |          |
| updated_at        | datetime   |                      |          |
| artists           | OneToMany  | OrphanTrue           | Artist   |
| favorites         | ManyToMany |                      | Favorite |
| reviews           | OneToMany  |                      | Review   |

---

### Artist

This entity represents an artist.

| Property      | Type       | Description          | Relation      |
|---------------|------------|----------------------|---------------|
| nickname      | string     | 30 NOT NULL          |               |
| number        | string     | 50 NOT NULL          |               |
| professional  | bool       | NOT NULL             |               |
| city          | string     | 50                   |               |
| country       | string     | 50                   |               |
| phone         | string     | 15 NOT NULL          |               |
| mail          | string     | 180 NOT NULL         |               |
| image         | string     | 255                  |               |
| bio           | text       |                      |               |
| birthyear     | string     | 4                    |               |
| created_at    | datetime   | NOT NULL             |               |
| updated_at    | datetime   |                      |               |
| user          | ManyToOne  | NOT NULL, OrphanTrue | User          |
| category      | ManyToOne  | NOT NULL             | Category      |
| tag           | ManyToMany |                      | Tag           |
| favorite      | ManyToMany |                      | Favorite      |
| musicalStyle  | ManyToMany | NOT NULL             | MusicalStyle  |
| instrument    | ManyToMany | NOT NULL             | Instrument    |
| ensemble      | ManyToMany |                      | Set           |
| performance   | ManyToMany |                      | Performance   |
| picture       | ManyToMany |                      | Picture       |
| video         | ManyToMany |                      | Video         |
| audio         | ManyToMany |                      | Audio         |
| website       | ManyToMany |                      | Website       |
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
| title       | string     | 30 NOT NULL  |          |
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

| Property    | Type      | Description  | Relation |
|-------------|-----------|--------------|----------|
| name        | string    | 30 NOT NULL  |          |
| image       | string    | 255 NOT NULL |          |
| description | string    | 255          |          |
| artists     | OneToMany | NOT NULL     | Artist   |

---

### Tag

### Tag
This entity represents a tag that links to a selection of artists.

| Property | Type       | Description | Relation |
|----------|------------|-------------|----------|
| name     | string     | 30 NOT NULL |          |
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
| name     | string     | 30 NOT NULL |          |
| artists  | ManyToMany |             | Artist   |

---

### MusicalStyle

This entity represents the musical style of an artist.

| Property | Type       | Description | Relation |
|----------|------------|-------------|----------|
| name     | string     | 30 NOT NULL |          |
| artists  | ManyToMany |             | Artist   |

---

### Instrument

This entity represents the intrument of an artist.

| Property | Type       | Description | Relation |
|----------|------------|-------------|----------|
| name     | string     | 30 NOT NULL |          |
| artists  | ManyToMany |             | Artist   |

---

### Favorite

This entity represents the favorite of an artist and a user.

| Property | Type       | Description | Relation |
|----------|------------|-------------|----------|
| user     | ManyToMany | NOT NULL    | User     |
| artists  | ManyToMany | NOT NULL    | Artist   |

---

### Audio

This entity represents the audio style of an artist.

| Property | Type       | Description  | Relation |
|----------|------------|--------------|----------|
| name     | string     | 30 NOT NULL  |          |
| link     | string     | 255 NOT NULL |          |
| artists  | ManyToMany |              | Artist   |

---

### Picture

This entity represents the picture style of an artist.

| Property | Type       | Description  | Relation |
|----------|------------|--------------|----------|
| name     | string     | 30 NOT NULL  |          |
| link     | string     | 255 NOT NULL |          |
| artists  | ManyToMany |              | Artist   |

---

### Video

This entity represents the video of an artist.

| Property | Type       | Description  | Relation |
|----------|------------|--------------|----------|
| name     | string     | 30 NOT NULL  |          |
| link     | string     | 255 NOT NULL |          |
| artists  | ManyToMany |              | Artist   |

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
| name     | string     | 30 NOT NULL  |          |
| link     | string     | 255 NOT NULL |          |
| artists  | ManyToMany |              | Artist   |

---

### SocialNetwork

This entity represents the social network of an artist.

| Property | Type       | Description  | Relation |
|----------|------------|--------------|----------|
| name     | string     | 30 NOT NULL  |          |
| link     | string     | 255 NOT NULL |          |
| artists  | ManyToMany |              | Artist   |

---

### Website

This entity represents the website of an artist.

| Property | Type       | Description  | Relation |
|----------|------------|--------------|----------|
| name     | string     | 30 NOT NULL  |          |
| link     | string     | 255 NOT NULL |          |
| artists  | ManyToMany |              | Artist   |

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
