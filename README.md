musiclib
========

Social network - music

__Classe usage:__

_User_:

- getId()
  - returns the User id
- getUrl()
  - returns the User URL

- getUsername()
  - returns the Username

- getEmail()
  - returns the email

- getPassword()
  - returns the password (sha1 encryption)

- isPublicEmail()
  - returns true if the email is public

- getPicture()
  - returns the profile picture path

- isActive()
  - returns true if the account is activated

---

- setUsername( $username:string )
  - changes the username

- setEmail( $email:string )
  - changes the email

- setPassword( $password:string )
  - changes the password

- setPublicEmail( $public: boolean )
  - changes the visibility of the email (true = public, false = private)

---

- __toString()
  - returns the username

---

- matchUsers( $number:int )
  - default $number = 1
  - returns an array of User who look similar to the current User

- getConnectionLog( $number:int)
  - default $number = 1
  - returns an array of Connection sorted by date (desc)

- resetPassword()
  - generate a random new password
  - returns true if the new password has been properly stored into the database and sent by email

- comment( $song:int, $text:string )
  - store a new comment or update the stored one comment

- rate( $song:int, $grade:int )
  - store a new grade or update the stored one

- addArtist()
  - create a new Artist
  - returns the new id

- addAlbum()
  - create a new Album
  - returns the new id

- getKnownSongs()
  - returns an array of Song known by the current User

- getOwnedSongs()
  - returns an array of Song owned by the current User

- getRatedSongs()
  - returns an array of Song rated by the current User 

- getCommentedSongs()
  - returns an array of Song commented by the current User

- getKnownSongCount()
  - returns an integer: number of songs known

- getOwnedSongCount()
  - returns an integer: number of songs owned

- getRatedSongCount()
  - returns an integer: number of songs rated

- getCommentedSongCount()
  - returns an integer: number of songs commented

---

- static login( $username:string, $password:string )
  - returns 0 the login couple is wrong, the id if it's true

- static logout()
  - logs the user out

- static getIdFromUsername( $username:string )
  - returns the id that matches the username

- static getUsernameFromId( $id:int )
  - returns the username that matches the id

- static checkUsername( $username:string )
  - returns 1 if the username is in the databse, 0 otherwise

- static checkEmail( $email:string )
  - returns 1 if the email is in the databse, 0 otherwise

- static validateEmail( $email:string )
  - returns true if the email is genuine, false otherwise

- static matchUsernamePassword( $username:string, $password:string )
  - returns 1 if the username matches the password, 0 otherwise

- static count()
  - returns the number of users

- static create( $username:string, $email:string, $password:string, $picture:string )
  - default $picture = ""
  - creates a new User
  - returns its id

- static delete( $user:int )
  - deletes a user
