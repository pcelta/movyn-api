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
make composer c=install
```

Start and run the docker containers

```sh
make start
```

Import seeds. This will populate your database with the relevant initial data

```sh
make import-seeds
```

You should be able to access this url: http://local-movyn-api/health-check in your browser. You should see the response below

```json
{
  "message": "Movyn API is up and running! Let's roll!"
}
```

### Other useful available commands

Show all available commands

```sh
make help
```

Stop the containers

```sh
make stop
```

Stop and remove all containers

```sh
make reset
```

If you need to get inside the php container
```sh
make ssh
```

To run the tests
```sh
make phpunit [path=path-to-a-file-or-folder]
```

To run bin/console commands
```sh
make bin c=<SOME-COMMAND>
```
