Cleoo Assessment
================

# Setup

You need to have `docker` and `docker-compose` installed (or, if your local environment contains php - you can just run it with `bin/console server:run`)

## To proceed with docker, you have to execute the following commands from the project root:

    docker-compose up -d --build

## To manage the REST functionality:

POST:

    curl -X POST -H "Content-Type: application/json" -d '{"meh":"value1","whatever":"value2"}' http://localhost/api/useless

GET:

    curl -X GET http://localhost/api/useless
    curl -X GET http://localhost/api/useless/1
