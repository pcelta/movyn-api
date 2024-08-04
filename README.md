### Pre-requirements

- Make
- Docker
- Docker Compose

### Installation

Add the following line to your /etc/hosts file
```sh
127.0.0.1 local-movyn-api
```

In the root directory, run the build command. This will build the necessary docker images

```sh
make build
```

To install all php dependencies
```sh
make composer-install
```

Start and run the docker containers

```sh
make start
```

### Other Available commands

Show all available commands

```sh
make help
```


Stop the containers

```sh
make stop
```

If you need to get inside the php container

```sh
make ssh
```

You should be able to access this url: http://local-movyn-api/health-check in your browser. You should see the response below

```json
{
  "message": "Movyn API is up and running! Let's roll!"
}
```
