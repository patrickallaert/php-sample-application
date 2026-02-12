# Item 2 – Application Containerization (Docker)

Este documento complementa el README original **sin modificar el código fuente**.  
Se publican dos imágenes en Docker Hub y se provee `docker-compose` para ejecutar la app.

## Imágenes públicas
- Web: https://hub.docker.com/r/jcabo65/php-sample-web
- DB:  https://hub.docker.com/r/jcabo65/php-sample-db

## Archivos relevantes en este repo
- `docker/Dockerfile.web` – imagen PHP/Apache de la aplicación.
- `docker/Dockerfile.db`  – imagen de base (MariaDB).
- `docker/docker-compose.yml` – orquesta `web` y `db` usando **las imágenes públicas**.
- `docker/docker-compose.override.yml` – comparte `/var/run/mysqld` para que la app (que usa `host=localhost`) conecte por **socket** sin cambiar código.

## Requisitos
- Docker + Docker Compose.

## Cómo ejecutar (2 líneas)
```bash
docker compose -f docker/docker-compose.yml -f docker/docker-compose.override.yml up -d
# abrir http://localhost:8080
