# Project 3
+ By: Luann Ebert
+ Production URL: <http://e15p3.yourdomain.com>

## Background
Restore Mass Ave is a volunteer group committed to protecting the trees along Washington CD's legendary Embassy Row. The street is undergoing a massive construction project that, while having many benefits, poses significant risks to these urban trees, many of which are over 100 years old. When and if fully developed, this app would enable volunteers to report the impacts of construction -- both and bad.  RMA would analyze and pass the reports on to city management and construction companies for resolution and recognization.

## Feature summary
 
+ RMA volunteers, or any concerned individual, can submit a report at the [homepage](http://e15p3.flyingdog.nu)
+ The report can include a photo and optional caption. The filenames of uploaded photos are automatically prepended with the observation date and street location for identification. 
+ RMA is automatically notified by email when a report is submitted. The email includes the photo and caption, if provided.
+ Authorized RMA administrators can [log in](http://e15p3.flyingdog.nu/tracker) to view a report list and delete individual reports. (Future iterations would allow report edits, and attaching notes.)
 
## Database summary

+ My application has 4 tables in total (`users`, `reports`, `photos`, `categories`)
+ There's a many-to-many relationship between `reports` and `categories`
+ There's a one-to-many relationship between `reports` and `photos`

## Outside resources
Primary I consulted the course videos and notes, the Laravel documentation, Laracasts, the class forum, and StackOverflow. A few specific references:
+ [image validation](https://www.tutsmake.com/image-validation-in-laravel/)
+ [writing files to directories](https://stackoverflow.com/questions/60831451/laravel-unable-to-write-in-the-var-www-html-laraapp)
+ [un-escaping html in blade](https://stackoverflow.com/questions/29253979/displaying-html-with-blade-shows-the-html-code)
+ [enabling larger filesize uploads](https://medium.com/@stefanledin/increase-file-upload-size-in-wordpress-on-nginx-server-19626f4ef8b9)
+ [updating php.ini](https://www.digitalocean.com/community/questions/how-to-update-php-ini-on-a-digitalocean-app)

## Notes for instructor
+ I have emailed my mailtrap.io credentials to you.
+ While I didn't get as far on this project as I had hoped, I learned a great deal from the course. Thank you!!!!

## Tests
Undergraduate - opting out