up:
	docker-compose up -d

down:
	docker-compose down

restart:
	docker-compose restart

build:
	docker-compose build

logs:
	docker-compose logs -f app

sh:
	docker exec -it app /bin/bash

compress:
	docker exec -it app php index.php
