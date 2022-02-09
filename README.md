# **Pronto Fuel**

**Pronto** Fuel is a heavilly opnionated starter kit for [**Laravel**](https://laravel.com/) and [**Inertia.js**](https://inertiajs.com/) powered by [**Vite**](https://vitejs.dev/). It ships with autoimporting features and leverages the latest and greatest features from [**Vue 3**](https://vuejs.org/).

## Features

-   ⏩ [Inertia.js](https://inertiajs.com/)
-   🔰 [Vue 3](https://github.com/vuejs/core)
-   ⚡️ [Vite](https://vitejs.dev/)
-   🎨 [Tailwind CSS](https://tailwindcss.com/)
-   🔥 Use the [new `<script setup>` syntax](https://github.com/vuejs/rfcs/pull/227) for Vue
-   📦 [Components auto importing](https://github.com/antfu/unplugin-vue-components)
-   ⬇️ [Common Vue and Inertia APIs auto importing](https://github.com/antfu/unplugin-auto-import)
-   😃 [Use icons from any icon sets, with no compromise](https://github.com/antfu/unplugin-icons)
-   🐋 [VSCode Dev Container](https://code.visualstudio.com/docs/remote/containers) with everything you need to start developing
-   🪲 Debug with [Ray](https://spatie.be/docs/ray/v1/introduction) on [port 23517](http://localhost:23517/) by default
-   👮 Enforce code quality with [ESLint](https://eslint.org/) and [StandardJS](https://standardjs.com/)

## Quick Start

```
git clone git@github.com:prontostack/pronto-fuel.git
cp .env.example .env
composer install
php artisan key:generate
php artisan migrate
npm install
npm start
```

## Quick Start with VSCode Dev Container

```
git clone git@github.com:prontostack/pronto-fuel.git
cp .env.example .env
code .

# Open VSCode's command palette
# Remote-Containers: Open Folder in Container

composer install
php artisan key:generate
php artisan migrate
npm install
npm start
```
