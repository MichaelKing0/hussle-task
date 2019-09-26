# Backend test - Url Shortener

## Running the application

The application is set up to run with Docker Compose (it'll take around 5 minutes to download all of the containers it needs to run):

```
docker-compose up -d
docker-compose exec urlshortener_app composer install && cp .env.example .env && php artisan key:generate && php artisan migrate --force
```

The NGINX image will forward port 2222, so you can access the application in your browser by visiting: http://localhost:2222

To stop the application, run:

```
docker-compose down
```

## Running the tests

Run the following command to run the unit tests (ensure the containers are up):

```
docker exec -it urlshortener_app vendor/bin/phpunit
```

## Decisions

- I chose Laravel as it is the framework I am most familiar with. As the application size is small, a microframework such as Lumen could have been used.
- The business logic resides in `app/UrlShortener`. I prefer component grouping like this to avoid huge folders of unrelated functionality (such as a single folder with all repositories). 
- I prefer to create services such as `UrlShortenerService` to provide a clean API to client code. This means the controllers can be slim with minimal business logic. It would also be trivial to expose the URL shortening functionality another way (such as a console command).   
- To ensure the URLs are as short as possible I am generating the shortened URLs by Base 62 encoding the IDs. The obvious downside of doing this is the generated URLs will be sequential. I've made the assumption that this isn't an issue.
- Due to the time constraints I focused on the most effective tests (feature tests and integration tests on the `UrlShortenerService`). Given more time I would add more unit tests.
