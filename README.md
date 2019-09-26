# Backend test - Url Shortner

## Running the application

The application is set up to run with Docker Compose:

```
docker-compose up -d
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

