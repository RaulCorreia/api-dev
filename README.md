## About
Test design for an api with a product crud, external api consumption, automated tests and design standards

## Required
- Docker Compose

## Run project
- Init docker

    
    docker-compose up -d

- Access terminal from docker


    docker-compose exec api sh

- Run commands to migrate


    php artisan migrate --seed

- Queue (if you needed)


    php artisan queue:work


## Routes
Headers

    Content-Type = application/json
    Accept  = application/json

### Products
- Get all products
> GET /api/product 

- Create product
> POST /api/product

Body params required

    {
        "name": "name",
	    "quantity": 0,
	    "type": 1
    }

-  Get product
> GET /api/product/{id}

- Update product
> PUT /api/product/{id} 

- Delete product
> DELETE /api/product/{id}

### Types
- Get all types
> GET /api/type

- Create type
> POST /api/type

Body

    {
        "name": "name",
    }
- Update type
> PUT /api/type/{id}
