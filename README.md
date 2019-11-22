WisePops Technical Task
=======================

# Setup

You need to have `docker` and `docker-compose` installed (or, if your local environment contains a proper version of 
PHP - you can just run it with `bin/console server:run`)

To proceed with docker, you have to execute the following commands from the project root:

    docker-compose up -d --build

After it's compiled, you would need to replace the api key for Fixier, either manually or with this command:

    docker-compose exec php
    KEY=your_key; sed -i -e 's/fixier_api_key:.*/fixier_api_key: '"$KEY"'/g' app/config/parameters.yml

## Automated Tests

    docker-compose exec php
    ./vendor/bin/simple-phppunit

## To test the exchange rate endpoint:

    curl -X POST \
    -H "Content-Type: application/json" \
    -d '{"items":{"42":{"currency":"EUR","price":49.99,"quantity":1},"55":{"currency":"USD","price":12,"quantity":3}},"checkoutCurrency":"EUR"}' \
    http://localhost/api/cart/exchange
