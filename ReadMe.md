# AKCE Payments API
An API for creating clients, client accounts and make transfers. Based on Lumen and Eloquent ORM using MySQL.

### Setup

- Install all the packages required via:
``` 
    composer install
```
- Create an empty schema.
- Copy the .env.example -> .env and alter the connection to point to the empty schema you created
- Run the migrations via:
``` 
    php artisan migrate
```
- Server the app via:
``` 
    php -S 127.0.0.1:11135 -t Interfaces\Http\Public
```

### Structure
**Note: Below you can find a file map showing the restructure of files**

The framework used was Lumen along with Eloquent as an ORM. A Domain Driven Design aproach was taken while creating the structure of the project. The following is an explanation of the layout:

- Application\ is a thin layer with no logic. This is where classes resposible for connecting the domains to the interfaces would lie. This layer currently contains the Providers and Execeptions.
- Domains\ is where all the buisness logic split into domains is contained.
- Infrastrucutre\ is where all the structural resources that all the domains rely on are stored. In this case all the core lumen structure was stored here. This allowed for decoupling of logic from the frameworks structure. Jobs, Utilities and other logic that is domain independent is also stored here. 
- Interfaces\ is where all the logic for displaying of information is stored.
- Testing\ is where all the PHPUnit test cases will be stored in a domain folder structure.

### Implemenation Process

A basic explanation of how I went about the implementation was, firstly I created a generic domain where I created a base repository and a base service that I could later inherit from. The base repository handles all the CRUD functions for the model and its defined relationships. The base service gives a way for the controller to interact with the repository. 

After creating the generic domain I laid out the schema needed and created the migrations. I then decided to segment the implemenation into two domains, one for client managment and one for transaction managment. Both domains inherit from the generic domain and extened where needed. A base crud controller was created. After creating the BaseCRUDController routes and controllers extending the BaseCRUDController were created for each domain.

Dependency injection was used in order to resolve contracts to actual implemenations.

### File Map [Laravel -> DDD structure]

- \bootstrap -> \Infrastructure\Lumen\bootstrap
- \database -> \Infrastructure\Lumen\database
- \storage -> \Infrastructure\Lumen\storage
- \vendor -> \Infrastructure\Lumen\vendor
- \tests -> \Tests
- \public -> \Interfaces\Http\Public
- \routes -> \Interfaces\Http\Routes
- \app\Http -> \Interfaces\Http\
- \app\Console -> \Interfaces\Console
- \app\Model.php -> \Domains\SpecificDomain\Models\Model.php