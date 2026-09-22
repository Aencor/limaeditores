# Lima Editores - Docker & WordPress Helper Makefile

include .env
export

.PHONY: help up down restart logs status install-wp install-woo theme-install theme-watch theme-build wp bash-wp bash-db backup-db

help: ## Muestra la lista de comandos disponibles
	@echo "================================================================"
	@echo " Lima Editores - WordPress + WooCommerce Docker Development"
	@echo " URL: https://local.limaeditores.com (o http://localhost:8082)"
	@echo " phpMyAdmin: http://localhost:8083"
	@echo " MariaDB Port: 3308"
	@echo "================================================================"
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-18s\033[0m %s\n", $$1, $$2}'

up: ## Inicia los contenedores en segundo plano
	docker compose up -d

down: ## Detiene los contenedores
	docker compose down

restart: ## Reinicia los contenedores
	docker compose restart

logs: ## Muestra los logs en tiempo real
	docker compose logs -f

status: ## Muestra el estado de los contenedores
	docker compose ps

install-wp: ## Instala WordPress con WP-CLI automáticamente
	docker compose run --rm wpcli core install \
		--url="http://local.limaeditores.com" \
		--title="Lima Editores - Librería Jurídica" \
		--admin_user="admin" \
		--admin_password="admin_password" \
		--admin_email="admin@limaeditores.com" \
		--skip-email
	docker compose run --rm wpcli theme activate limaeditores
	docker compose run --rm wpcli rewrite structure '/%postname%/' --hard

install-woo: ## Instala y activa WooCommerce y páginas por defecto
	docker compose run --rm wpcli plugin install woocommerce --activate
	docker compose run --rm wpcli plugin activate advanced-custom-fields-pro || true

theme-install: ## Instala las dependencias de Node para compilar el tema
	npm install

theme-watch: ## Inicia el compilador en modo watch con BrowserSync
	npm run watch

theme-build: ## Compila los assets de producción
	npm run prod

wp: ## Ejecuta comandos de WP-CLI (Ejemplo: make wp CMD="plugin list")
	docker compose run --rm wpcli $(CMD)

bash-wp: ## Accede a la terminal del contenedor de WordPress
	docker compose exec wordpress bash

bash-db: ## Accede a la terminal de MariaDB
	docker compose exec database mariadb -u$(MYSQL_USER) -p$(MYSQL_PASSWORD) $(MYSQL_DATABASE)

backup-db: ## Genera un volcado SQL de la base de datos
	mkdir -p backup
	docker compose exec database mariadb-dump -u$(MYSQL_USER) -p$(MYSQL_PASSWORD) $(MYSQL_DATABASE) > backup/dump_$$(date +%Y%m%d_%H%M%S).sql
	@echo "Backup guardado en la carpeta backup/"
