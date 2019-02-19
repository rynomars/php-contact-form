# Example Laravel Project

This is an example Laravel 5.7 project. This is not production ready code.

## Installation
After cloning the repo:

To install the app run the di_init.bash file
```
./di_init.sh
```
This script initialize the database, creates the mysql user di_user, runs the composer install,
and the laravel migration. The script will create the database using mysql root. You will be
promted for the mysql root password during execution.

### NOTE:
```
The laravel .env is committed with this repo. Normally this is a very bad practice :-). 
This is only done for demo purposes!
```

After installation you can run your commands to run the unit test and server the app.
