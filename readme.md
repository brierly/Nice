# Social Thing #
**THIS IS STILL VERY VERY BAD BY ALL STANDARDS. Will be experimenting with this further.**
An iteration on AV, which was a project to get started with learning the fundamentals of PHP. 
Now creating more secure and higher quality code. *(Well, better than before anyway)*
Removed all focus from styling and branding stuff, now just want to work on functionality and efficiency.

**A functional demo version is hosted at [sleepng.club/social](http://sleepng.club/social/)**

Hosting locally:
* Create new mysql database for website
* Change server settings in serverconfig.php according to MySql settings 
    - set `dbname` to the database just created
* Import the `DatabaseInit.sql` file as a query in newly made database
* Give write permissions as app creates directories and uploads files
    - `sudo chown -R www-data directory_of_website`