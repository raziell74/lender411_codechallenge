# Lender411 Code Challenge

## Easy Code Review

There is a pull request open for the branch **code_challenge**. This is to make it easier for you to review the code for only the files I've touched. When cloneing the project to run it on your local machine please remember to switch to the code_challenge branch as that's where all my work is. 

## Homestead

This is an out of the box laravel homestead project so all the defaults were used within homestead. For example the database is using the default homestead:secret user so if you're not using homestead please ensure to update the .env file for your local set up.

## Unit Testing changes

I've updated the phpunit files to look at a new database. To ensure phpunit runs properly please create a the **homestead_test** database and grant the homestead user access. 

A seperate testing database will make sure we're working with a clean version of the database for every test and do not recieve test failures from stale data hanging out in the db.

## API Authentication

Laravels Passport implementation for OAuth is used in this project. 
When pulling the code please remember to run ```artisan passport:install``` after you run the migrations.
This will generate the API keys for authentication because they are not included in the migration seeds.

## Frontend API Token Management

If you access the project through a browser you can login with the following credintials to create and manage
OAuth Passport tokens.

**User Email**: jordan@lender411.com (It's important to visualize your goals)
**Password**: secret

## Challenge Parameters

### Create a REST API using the Laravel PHP framework to model sports teams and their players.

#### Be sure to include the following elements:

- migration for adding the teams table
- migration for adding the players table
- seed script to fill the tables with some data
- API endpoint to add a team
- API endpoint to add a player
- API endpoint to update a player
- API endpoint to get a team and its players
- Bonus: authentication method so only trusted entities may call the APIs

#### Schema for teams table (you may add additional fields as needed):

- id
- name
- created_at
- updated_at

#### Schema for players table (you may add additional fields as needed):

- id
- first_name
- last_name
- created_at
- updated_at
