# DeliverySchema
> Bicomatics Platform and Dashboard

## installing

### Backend Librabries

install php vendor

`composer install`

### FrontEnd Node Librabries

install npm packages and compile js for production

`npm install`

`npm run prod` for Deployment 
`npm run watch` for Development 

### Configration File .ENV

Create .env file like .env.example file and modify server credentials and

Change QUEUE_CONNECTION to redis

Change BROADCAST_DRIVER to redis

Change CACHE_DRIVER to redis

### FireBase Tokens Important  //when we have Mobile App to push Notification

Add fireBase Token to this file 
"deliverySchema\database\seeds\UsersSeeder.php"
In Each Value for Red & Gold and Foucus while Adding

Remove "Here" and Put Tokens

{

    Branch::create([

            'application_name' => 'Tayar',

            'firebase_token' => 'Here'

    ]);

   Branch::create([

          'application_name' => 'Lead',

          'firebase_token' => 'Here'

   ]);
   
   Branch::create([

          'application_name' => 'Company',

          'firebase_token' => 'Here'

   ]);

}

### DataBase& Backend

run migration

`php artisan migrate -- seed`

create jwt token

`php artisan jwt:secret`

create App key

`php artisan key:generate`

Connect to Stoarge

`php artisan stoarge:link`

### RealTime // initiate if we turn on realtime

initialise laravel echo server

`laravel-echo-server init`

run laravel echo server in project directory.

`laravel-echo-server start`

run queue listener

`php artisan queue:listen`

you can use supervisor to run process of echo server and run queue in background.check link down below //Deployment On Linux Only 

`https://blog.whabash.com/posts/installing-supervisor-manage-laravel-queue-processes-ubuntu`

### API Command Line //only If it Found  
