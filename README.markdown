## Track

### GET

Select a track object

> 	http://api.dev/track/:track_id

Required parameters:
* GET (int) :user_id

*****

## User

### GET

Select a user object

	http://api.dev/user/:user_id

Required parameters:
* GET (int) :user_id

*****

## Favorites

### GET

Select all tracks from user's favorites

	http://api.dev/user/:user_id/favorites

Required parameters:
* GET (int) :user_id

### POST

Add a track to user's favorites

	http://api.dev/user/:user_id/favorites/track

Required parameters:
* GET (int) :user_id
* POST (int) :track_id

### DELETE

Remove a track from user's favorites

	http://api.dev/user/:user_id/favorites/track

Required parameters:
* GET (int) :user_id
* (int) :track_id