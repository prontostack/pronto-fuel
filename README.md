# **Pronto Fuel**

**Pronto** Fuel is a heavilly opnionated starter kit for [**Laravel**](https://laravel.com/) and [**Inertia.js**](https://inertiajs.com/) powered by [**Vite**](https://vitejs.dev/). It ships with autoimporting features and leverages the latest and greatest features from [**Vue 3**](https://vuejs.org/).

## Features

-   ⏩ [Inertia.js](https://inertiajs.com/)
-   🔰 [Vue 3](https://github.com/vuejs/core)
-   ⚡️ [Vite](https://vitejs.dev/)
-   🔥 Use the [new `<script setup>` syntax](https://github.com/vuejs/rfcs/pull/227) for Vue
-   📦 [Components auto importing](https://github.com/antfu/unplugin-vue-components)
-   ⬇️ [Common Vue and Inertia APIs auto importing](https://github.com/antfu/unplugin-auto-import)
-   ✂️ Pages Code Splitting out of the box
-   🔔 Server Driven toast notification system with queue in place
-   💬 Server Driven dialogs
-   ⚓ Inline Inertia Persistent Layouts
-   🎨 [Tailwind CSS](https://tailwindcss.com/) configured with common [PostCSS](https://postcss.org/) plugins, like [nesting](https://github.com/csstools/postcss-plugins/tree/main/plugins/postcss-nesting) and [extend rule](https://github.com/csstools/postcss-extend-rule).
-   ❄️ [Quasar Framework](https://quasar.dev/) configured out of the box with over 70 ready to use Material Design components
-   😃 [Use icons from any icon sets, with no compromise](https://github.com/antfu/unplugin-icons)
-   🐋 [VSCode Dev Container](https://code.visualstudio.com/docs/remote/containers) with everything you need to start developing
-   🪲 Debug with [Ray](https://spatie.be/docs/ray/v1/introduction) on [port 23517](http://localhost:23517/) by default
-   👮 Enforce code quality with [ESLint](https://eslint.org/) and [StandardJS](https://standardjs.com/)

## Quick Start with VSCode Dev Container

```bash
# Clone the repo
git clone git@github.com:prontostack/pronto-fuel.git my-app

# Enter the project directory
cd my-app

# Create a .env files based on the provided example one
cp .env.example .env

# Open the project on VSCode
code .

# *****************************************************************
# Install the Remote-Containers extensions if you still haven't
# Open VSCode's command palette (Eg.: ctrl + shift + p on Windows)
# Select "Remote-Containers: Open Folder in Container"
#
# IMPORTANT: The following commands must be executed in the VSCode
# integrated terminal, once the Dev Container has started, since it
# is running inside the container
# *****************************************************************

# Install PHP dependencies
composer install

# Generate an APP key for security
php artisan key:generate

# Create the database tables
php artisan migrate

# Instal frontend dependencies
npm install

# *****************************************************************
# At this point, before you actually run the project, you might
# need to close the remote connection to the Dev Container and
# reopen it. See Troubleshooting below for more info.
# *****************************************************************

# Lift Vite's development server
npm start

# Go to http://localhost
```

## Quick Start without VSCode Dev Container

```bash
# Clone the repo
git clone git@github.com:prontostack/pronto-fuel.git my-app

# Enter the project directory
cd my-app

# Create a .env files based on the provided example one
cp .env.example .env

# Install PHP dependencies
composer install

# Generate an APP key for security
php artisan key:generate

# Create the database tables
php artisan migrate

# Instal frontend dependencies
npm install

# Update server configs on vite.config.js
# to be like this
server: {
    port: 3000
},

# Lift Vite's development server

npm start

# Go to http://localhost
```

## Troubleshooting

If you're using the VSCode Dev Container and your home page isn't loading at [http://localhost](http://localhost), you probably hit an issue where the PHP container isn't able to find the `vendor/autoload.php` file you just installed via `composer install`. In this case, simply close the remote connection to the container and reopen the folder in the container on VSCode.
