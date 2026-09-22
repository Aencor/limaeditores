# Lima Editores — WordPress + WooCommerce con Docker

Entorno de desarrollo local dockerizado y tema a medida para la tienda y editorial jurídica **Lima Editores** en el puerto estándar 80 (`http://local.limaeditores.com`), basado en la arquitectura de `Aencor/WordPress-Docker-Starter-Theme`.

---

## 🚀 Requisitos Previos

- [Docker Desktop](https://www.docker.com/products/docker-desktop) instalado y en ejecución.
- [Node.js](https://nodejs.org/) (versión 18+ o 20+ recomendada) y `npm`.

---

## ⚙️ Configuración Inicial

### 1. Configuración de Dominio Local (`/etc/hosts`)
Para poder navegar directamente mediante `http://local.limaeditores.com`, agrega la siguiente línea a tu archivo de hosts de macOS:

```bash
sudo sh -c 'echo "127.0.0.1 local.limaeditores.com" >> /etc/hosts'
```

### 2. Variables de Entorno
El archivo `.env` ya viene configurado en el puerto 80:
```bash
cp .env.example .env
```

---

## 🐳 Comandos de Docker

Puedes usar `make` o los comandos directos de `docker compose`:

| Acción | Comando Make | Comando Docker |
|---|---|---|
| **Iniciar entorno** | `make up` | `docker compose up -d` |
| **Detener entorno** | `make down` | `docker compose down` |
| **Ver logs en tiempo real** | `make logs` | `docker compose logs -f` |
| **Instalar WordPress vía CLI** | `make install-wp` | `docker compose run --rm wpcli core install ...` |
| **Instalar y activar WooCommerce** | `make install-woo` | `docker compose run --rm wpcli plugin install woocommerce --activate` |
| **Ejecutar comandos WP-CLI** | `make wp CMD="plugin list"` | `docker compose run --rm wpcli <comando>` |
| **Entrar al contenedor WP** | `make bash-wp` | `docker compose exec wordpress bash` |
| **Copia de seguridad BD** | `make backup-db` | Crea dump SQL en `./backup/` |

---

## 🎨 Desarrollo del Tema Frontend (Laravel Mix + Tailwind + SCSS)

El tema personalizado se encuentra en: `wp-content/themes/limaeditores/`.

1. **Instalar dependencias de Node:**
   ```bash
   npm install
   ```

2. **Compilar en modo desarrollo y observar cambios (Watch + BrowserSync):**
   ```bash
   npm run watch
   ```

3. **Compilar para producción (Minificado y optimizado):**
   ```bash
   npm run prod
   ```

---

## 🌐 URLs y Servicios

| Servicio | URL | Credenciales por defecto |
|---|---|---|
| **Sitio Web** | [http://local.limaeditores.com](http://local.limaeditores.com) | `admin` / `admin_password` (tras `make install-wp`) |
| **phpMyAdmin** | [http://localhost:8081](http://localhost:8081) | Servidor: `database` <br> Usuario: `root` <br> Contraseña: `limaeditores_root_pass` |
| **MariaDB (MySQL)** | `localhost:3306` | Base: `limaeditores_db` <br> Usuario: `limaeditores_user` <br> Contraseña: `limaeditores_pass` |

---

## 📚 Estructura del Proyecto

```text
limaeditores/
├── docker-compose.yml       # Definición de servicios Docker en puerto 80 (MariaDB, WP, phpMyAdmin, WP-CLI)
├── uploads.ini              # Configuración de memoria y subida de archivos PHP
├── package.json             # Dependencias de compilación Frontend (Laravel Mix, Tailwind, GSAP)
├── webpack.mix.js           # Pipeline de compilación de assets del tema
├── tailwind.config.js       # Configuración de diseño con paleta jurídica
├── Makefile                 # Automatizaciones para Docker y WP-CLI
├── wp-content/
│   ├── plugins/
│   │   └── advanced-custom-fields-pro/
│   └── themes/
│       └── limaeditores/     # Tema custom para la librería jurídica
│           ├── functions/
│           │   ├── init.php
│           │   ├── scripts.php
│           │   ├── woocommerce.php  # Hooks para libros jurídicos, ISBN, autores
│           │   ├── options.php
│           │   ├── blocks.php
│           │   └── security.php
│           ├── header.php
│           ├── footer.php
│           ├── index.php
│           ├── woocommerce.php
│           └── assets/
│               ├── scss/
│               ├── js/
│               └── build/
└── README.md
```
