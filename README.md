## How to set up your local environment on Mac OS


### Pre-requirements
- Docker
- Docker Compose

### Installation

Add the following line to your /etc/hosts file
```sh
127.0.0.1 local-movyn-api
```


In the root directory, build the php local image

```sh
docker build -t movyn-php-fpm .dev/php
```


In the .dev directory, spin up docker compose

```sh
cd .dev
docker-compose up -d
```

You should be able to access this url: http://local-movyn-api/health-check in your browser. You should see the response below

```json
{
  "message": "Movyn API is up and running! Let's roll!"
}
```
