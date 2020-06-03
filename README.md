# Simple Club Membership Application

A Simple CLub Membership Application developed with Laravel PHP Framework.

## Installation

- Clone github repo
```shell script
git clone https://github.com/MisterMike/MemberClub.git
````
 
- Optionally you can change the name of the folder:

````shell script
git clone https://github.com/MisterMike/MemberClub.git club-membership
````

- Go to the newly created folder which was 'club-membership' in the above example

```shell script
cd club-membership
````

- Make both the storage and the bootstrap/cache directories writable by Apache (or Nginx).

````shell script
sudo chmod -R o+rw storage
sudo chmod -R o+rw bootstrap/cache
````
 
- Install node packages by npm _(This step is only necessary if you are planning to make further developments in this app.)_

````shell script
npm install
````

- Run composer

````shell script
composer install --optimize-autoloader --no-dev
````

- Create .env file by copying the default env file
````shell script
cp .env.example .env
````

- Generate application key (Laravel will not run without this unique key)

````shell script
php artisan key:generate
````

- Open .env file and edit necessary config based on the server/virtual machine you use to run it

````shell script
nano .env
````

- Add symbolic links in order to make storage files viewable for public.

````shell script
php artisan storage:link
````

- As a best practice, you might want to run the following command for performance.
````shell script
php artisan config:cache
````

- Create a MySQL database and enter the credentials into the .env file. 

- Now it is time to migrate our database tables. Use Laravel migrate command.

````shell script
php artisan migrate:install
php artisan migrate
````

- Now let's add some mockup data. There are already factory and seed files in this Laravel application so the only thing you need to do is to run those:

````shell script
php artisan db:seed
````

- This command will create 10 memberships and 10 members for each membership as well as 2 app users, one being an adminstrator.


- As mentioned above, seed command creates 2 users as follows:
    * Club Administrator, **admin@myclub.com** (password is password)
    * Finance Manager, **manager@myclub.com** (password is password)

- Now you can go to your url and login to the system by using the credentials above.

## Additional Features

- This App provides Restful API endpoints for memberships and members. Every user has an API token by default. 
Using API tokens, one can get to use APIs with several ways as below by using Guzzle HTTP library.

    * Query String
    ````shell script
    $response = $client->request('GET', '/api/memberships?api_token='.$token);
    ```` 
  
    * Request Payload
    ````shell script
    $response = $client->request('POST', '/api/memberships', [
        'headers' => [
            'Accept' => 'application/json',
        ],
        'form_params' => [
            'api_token' => $token,
        ],
    ]);
    ```` 

    * Bearer Token
    ````shell script
    $response = $client->request('POST', '/api/mnemberships', [
        'headers' => [
            'Authorization' => 'Bearer '.$token,
            'Accept' => 'application/json',
        ],
    ]);
    ```` 

- Club Membership App has multi language support. Currently English and German have translations for dashboard. If you need more you are welcome to edit language files.
