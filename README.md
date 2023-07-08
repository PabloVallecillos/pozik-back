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

Check the commands in the Makefile, to run one make target_name. Example: `make up`

### Auth

- Auth scaffold thanks to [Laravel Breeze](https://laravel.com/docs/10.x/starter-kits#laravel-breeze) with [api](https://laravel.com/docs/10.x/starter-kits#breeze-and-next) scaffold
- 
##
