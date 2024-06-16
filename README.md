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

This entity represents a user of the platform. The user can be a traveler or a host. They are defined by the `role` property.

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

This entity represents a room for rent.

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
| category      | ManyToOne  |                      | Category      |
| tag           | ManyToMany |                      | Tag           |
| favorite      | ManyToMany |                      | Favorite      |
| musicalStyle  | ManyToMany |                      | MusicalStyle  |
| instrument    | ManyToMany |                      | Instrument    |
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

---

### Review

This entity represents a review made by a traveler to a booking for a room.

| Property | Type      | Description | Relation |
|----------|-----------|-------------|----------|
| title    | string    | 50 NOT NULL |          |
| comment  | text      |             |          |
| rating   | integer   | NOT NULL    |          |
| user     | ManyToOne | NOT NULL    | User     |
| artist   | ManyToOne |             | Artist   |

---

### Event

This entity represents a booking made by a traveler to a room.

| Property    | Type     | Description  | Relation |
|-------------|----------|--------------|----------|
| location    | string   | 50 NOT NULL  |          |
| title       | string   | 30 NOT NULL  |          |
| date        | datetime |              |          |
| description | text     |              |          |
| address     | string   | 50           |
| city        | string   | 50           |          |
| zip         | string   | 5            |          |
| country     | string   | 50           |          |
| image       | string   | 255 NOT NULL |          |
| link        | string   | 255          |          |
| created_at  | datetime | NOT NULL     |          |
| updated_at  | datetime |              |          |


---

### Category

This entity represents the equipments for a room.

| Property    | Type      | Description  | Relation |
|-------------|-----------|--------------|----------|
| name        | string    | 50 NOT NULL  |          |
| image       | string    | 255 NOT NULL |          |
| description | string    | 255          |          |
| artists     | OneToMany | NOT NULL     | Artist   |

---

### Tag

This entity represents the equipments for a room.

| Property | Type       | Description | Relation |
|----------|------------|-------------|----------|
| name     | string     | 30 NOT NULL |          |
| artists  | ManyToMany |             | Artist   |

---

### Performance

This entity represents the equipments for a room.

| Property | Type       | Description | Relation |
|----------|------------|-------------|----------|
| type     | string     | 30 NOT NULL |          |
| location | string     | 50          |          |
| artists  | ManyToMany |             | Artist   |

---

### Set

This entity represents the equipments for a room.

| Property | Type       | Description | Relation |
|----------|------------|-------------|----------|
| name     | string     | 30 NOT NULL |          |
| artists  | ManyToMany |             | Artist   |

---

### MusicalStyle

This entity represents the equipments for a room.

| Property | Type       | Description | Relation |
|----------|------------|-------------|----------|
| name     | string     | 30 NOT NULL |          |
| artists  | ManyToMany |             | Artist   |

---

### Instrument

This entity represents the equipments for a room.

| Property | Type       | Description | Relation |
|----------|------------|-------------|----------|
| name     | string     | 30 NOT NULL |          |
| artists  | ManyToMany |             | Artist   |

---

### Favorite

This entity represents the equipments for a room.

| Property | Type       | Description | Relation |
|----------|------------|-------------|----------|
| user     | ManyToMany | NOT NULL    | User     |
| artists  | ManyToMany | NOT NULL    | Artist   |

---

### Audio

This entity represents the equipments for a room.

| Property | Type       | Description  | Relation |
|----------|------------|--------------|----------|
| name     | string     | 30 NOT NULL  |          |
| link     | string     | 255 NOT NULL |          |
| artists  | ManyToMany |              | Artist   |

---

### Picture

This entity represents the equipments for a room.

| Property | Type       | Description  | Relation |
|----------|------------|--------------|----------|
| name     | string     | 30 NOT NULL  |          |
| link     | string     | 255 NOT NULL |          |
| artists  | ManyToMany |              | Artist   |

---

### Video

This entity represents the equipments for a room.

| Property | Type       | Description  | Relation |
|----------|------------|--------------|----------|
| name     | string     | 30 NOT NULL  |          |
| link     | string     | 255 NOT NULL |          |
| artists  | ManyToMany |              | Artist   |

---

### EventPlatform

This entity represents the equipments for a room.

| Property | Type       | Description  | Relation |
|----------|------------|--------------|----------|
| name     | string     | 30 NOT NULL  |          |
| link     | string     | 255 NOT NULL |          |
| artists  | ManyToMany |              | Artist   |

---

### MusicPlatform

This entity represents the equipments for a room.

| Property | Type       | Description  | Relation |
|----------|------------|--------------|----------|
| name     | string     | 30 NOT NULL  |          |
| link     | string     | 255 NOT NULL |          |
| artists  | ManyToMany |              | Artist   |

---

### SocialNetwork

This entity represents the equipments for a room.

| Property | Type       | Description  | Relation |
|----------|------------|--------------|----------|
| name     | string     | 30 NOT NULL  |          |
| link     | string     | 255 NOT NULL |          |
| artists  | ManyToMany |              | Artist   |

---

### Website

This entity represents the equipments for a room.

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
