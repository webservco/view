# webservco/view

## Development

```sh
DOCKER_IMAGE_TAG='webservco-component-view';
DOCKER_CONTAINER_NAME='webservco-component-view-container';
docker build --tag ${DOCKER_IMAGE_TAG} -f .docker/config/php82-cli-copy/Dockerfile .
docker run -it --rm --name ${DOCKER_CONTAINER_NAME} ${DOCKER_IMAGE_TAG} /bin/bash -c "composer check:phpcs"
```
