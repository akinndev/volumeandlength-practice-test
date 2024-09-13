## Development

Make sure your local was installed Docker and inclued `docker-compose`

- Check `docker-compose` version

```
docker-compose --version
```

- Start containers

```
docker-compose up -d
```

- Connect into `app` container and run commands to setup Laravel

```
docker-compose exec app bash
composer install
php artisan key:generate
.....
```

- Stop containers

```
docker-compose down
```

- Check logs

```
docker-compose logs -f
```

- Restart containers

```
docker-compose restart
```

### Run view and test

- Before start run command
```
npm run dev
```

then access uri https://localhost:8000

- Check the preview screenshots at public/screenshots folder