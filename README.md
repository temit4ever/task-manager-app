## About the App

Simple Laravel web application for task management: To use the app user has to register and log in.

## How to use the app
- Clone the file and cd into the project folder
- Run composer install
- Copy the `.env.example` to `.env`
- Run `docker-compose up -d --build` to build the mysql container
- Run the migration command to set up necessary tables
- If there is a connection error after running migration, you can change the `DB_HOST` value to `127.0.0.1` and then run docker command above again and then run the migration
- Also, Run `npm install` to bring in the node_modules and any necessary third party packages.
- You can also run the artisan command for test
- Run the serve artisan command to get the app running
- Lastly, get the http address the artisan command above produce and pop it into the browser



