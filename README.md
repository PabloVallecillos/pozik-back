# Pozik api

## Development

### Docker
- Install docker in arch linux systems.

```
sudo pacman -Syu

sudo pacman -S docker

sudo systemctl start docker.service
sudo systemctl enable docker.service

reboot

sudo pacman -S docker-compose
```

The application uses docker thanks to [Laravel Sail](https://laravel.com/docs/10.x/sail).

### Makefile

Check the commands in the Makefile, to run one make target_name. Example: `make up`

### Github actions

- See pull-requests.yml
  - To save execution time in the action, I decided to build the application locally and upload it to the docker hub, so that the action uses it and I don't have to build it unnecessarily.
  - `sail build` and upload pablovallecillos/pozik_back to docker hub.
    ```
      docker tag pozik_back:latest pablovallecillos/pozik_back:latest
      docker push pablovallecillos/pozik_back:latest
    ```

### Auth

- Auth scaffold thanks to [Laravel Breeze](https://laravel.com/docs/10.x/starter-kits#laravel-breeze) with [api](https://laravel.com/docs/10.x/starter-kits#breeze-and-next) scaffold
