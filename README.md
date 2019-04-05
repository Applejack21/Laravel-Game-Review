# Review System
George Goodall | U1556029@unimail.hud.ac.uk | U1556029

Review system that is built in Laravel 5.7 that allows users to upload reviews of games and comment on other reviews.

The system includes:
- Charts from Chart.js to display how many reviews the user has made per rating (0-5) and how many comments they have
made on the system
- An email is sent if someone comments on one of your reviews
- Verification of the user's email, to prove they are who they say they are. This has been made using the built-in verification of Laravel 5.7
- Pagination to help limit the amount shown on each page, styled with Bootstrap
- Bootstrap to help with overall CSS
- jQuery UI to help with overall style and additions to the system.

## Setup
Follow these steps to setup the application:

1. Download/clone laravel framework from GitHub (https://github.com/laravel/laravel)
2. Download/clone this repo
3. Copy everything from this repo, into the folder created with the laravel framework in it, overwriting any changes needed
4. Navigate to the folder using shell, and type ```php artisan serve --port=8080```
5. Type in localhost:8080/login and you should see the login screen of the application.

For the database to work correctly, you would need to change the ".env.example" to ".env" and change the values of the database within there. This won't work by default due to database tables/field names needing to be the same.

### Issues regarding losing commits:
~~Update 1: The latest commit (8b31560) seems to have deleted all other commits between 26/03 to the 09/03. I have no idea how this happen, nor a way to restore the previous commits.~~

Update 2: The above has been fixed after recovering the branches (emails, your_details, authentication_system) and pushing them to the repo. Closed pull requests show you the different commits per branch.

recover-branch: commits done for the "emails" branch.\
recover-branch-details: commits done for the "your_details" and "authentication_system" branches.
