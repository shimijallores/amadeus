# Amadeus - AI Coding Assistant Instructions

## Project Overview

This is a custom PHP MVC web application for managing airline operations, including airlines, airports, aircraft, flight routes, and schedules. It uses a lightweight custom framework with dependency injection, routing, and validation.

## Architecture

- **Entry Point**: `public/index.php` loads bootstrap, routes, and handles requests
- **Core Framework**: Located in `Core/` - Router, Database (PDO wrapper), Session management, Validator, App container, Middleware
- **HTTP Layer**: `Http/controllers/` (CRUD operations), `Http/models/` (database interactions), `Http/forms/` (validation), `Http/views/` (templates with Alpine.js)
- **Database**: MySQL with tables for airlines, airports, aircraft, flight_routes, flight_schedules, airline_users, users, passengers, seats
- **Frontend**: Tailwind CSS (compiled via npm), Alpine.js for interactivity, custom JS in `public/scripts/`

## Key Patterns & Conventions

- **Routing**: Exact URI matching in `routes.php`, middleware ('admin' or 'guest') applied per route
- **Controllers**: Located in `Http/controllers/{resource}/`, e.g., `airlines/index.php` - query data, require view
- **Models**: In `Http/models/`, extend nothing, use `App::resolve(Database::class)`, methods like `store()`, `update()`, `destroy()`
- **Forms**: Extend `Http\forms\Form`, implement `__construct()` with `Validator::` calls, throw `ValidationException` on failure
- **Views**: `.view.php` files, use `require base_path('Http/views/partials/...')`, Alpine.js with `x-data`, tables with `data-field` attributes
- **Validation**: Custom `Core\Validator` with `string()`, `email()`, `number()`, `phone()`, `image()` - strict length checks
- **Session**: Flash messages with `Session::flash('success', '...')`, role checks with `Session::role(['admin'])`
- **Middleware**: `Admin` checks `$_SESSION['user']`, redirects to `/login` if missing
- **Database Queries**: Raw SQL with named parameters, e.g., `$db->query("SELECT * FROM airlines WHERE id = :id", ['id' => $id])->get()`
- **Roles**: 'admin' sees all, 'staff' sees only their airline (filter by `airline_id`), 'user' limited access
- **File Uploads**: Use `enctype="multipart/form-data"`, validate with `Validator::image()`
- **Excel Handling**: `Http\Services\ExcelService` with PhpSpreadsheet for import/export

## Dependencies & Setup

- **PHP**: Requires `ext-pdo`, `ext-curl`, `ext-fileinfo` for MySQL, HTTP, file validation
- **Composer**: `vlucas/phpdotenv` for env, `phpoffice/phpspreadsheet` for Excel
- **NPM**: `tailwindcss` for styling, run `npm run dev` to watch/compile CSS to `public/dist/style.css`
- **Environment**: `.env` file with `DATABASE_*` vars, loaded in `public/index.php`

## Development Workflow

- **Run Locally**: Use PHP built-in server `php -S localhost:8000 -t public/`
- **Database**: Import `database/database.sql`, ensure MySQL running
- **Build CSS**: `npm run dev` (watches for changes)
- **Install**: `composer install && npm install`
- **Testing**: No formal tests; manually verify CRUD operations, validation, role restrictions
- **Debugging**: Check `Session::get('errors')` for validation failures, use `var_dump()` in controllers

## Common Tasks

- **Add New Resource**: Create controller files in `Http/controllers/{resource}/`, add routes in `routes.php`, create model in `Http/models/`, form in `Http/forms/`, views in `Http/views/{resource}/`
- **Database Changes**: Update `database/database.sql`, run manually or via migration (none implemented)
- **Validation**: Add rules in form `__construct()`, use `Validator::` methods, display errors in views via `Session::get('errors')`
- **Permissions**: Check `Session::role()` in controllers/views, filter queries by `$_SESSION['user']['airline_id']` for staff
- **Import/Export**: Use `ExcelService` in controllers, handle file uploads in forms

## Examples

- **Controller Query**: `$airlines = $db->query("SELECT * FROM airlines")->get();`
- **Role Filter**: `if ($user['role'] === 'staff') { $query .= " WHERE id = :id"; $params['id'] = $user['airline_id']; }`
- **Form Validation**: `if (!Validator::string($attributes['iata'], 3, 3)) { $this->errors['iata'] = "Enter valid IATA"; }`
- **View Loop**: `<?php foreach ($airlines as $airline): ?> <td data-field="iata"><?= $airline['iata'] ?? 'N/A' ?></td> <?php endforeach; ?>`
- **Alpine Modal**: `<button @click="showModal=true" x-data="{showModal: false}">Edit</button>`

## Gotchas

- Routes use exact matches; no wildcards or parameters
- Controllers directly `require` views; no templating engine
- Database connections via container; always `App::resolve(Database::class)`
- Validation throws exceptions; caught in `public/index.php` to flash and redirect
- Staff users see only their airline's data; filter everywhere
- File paths use `base_path()` helper from `Core/functions.php`
- Alpine.js for modals/tables; no Vue/React
- Tailwind compiled to single CSS file; no component libraries
