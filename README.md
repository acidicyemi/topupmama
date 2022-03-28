
# Topupmama

Topupmama Backend Engineer Assessment Test


## Documentation

download the postman documentation [Documentation](https://documenter.getpostman.com/view/5487875/UVyoVHn1)


## Environment Variables

To run this project, you will need to rename the .env.example to .env

```bash
  cp .env.example .env
```


## Run Locally

Clone the project

```bash
  git clone https://github.com/acidicyemi/topupmama.git
```

Go to the project directory

```bash
  cd topupmama
```

start the app with docker compose dependencies

```bash
  docker-compose up --build
```

run migration open container shell and run

```bash
  php artisan migrate && php artisan db:seed
```
Start the server will run on the port you specified in your .env




## Authors

- [@acidicyemi](https://www.github.com/acidicyemi)
