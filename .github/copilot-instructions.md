# Amadeus AI Agent Instructions

This document guides AI agents working in the Amadeus Global Distribution System codebase. Follow these patterns when making changes.

## Project Architecture

- **Custom MVC Framework**: No Laravel/Symfony - everything is custom-built
  - `Core/`: Framework classes (Router, Container, Database, Session, Validator)  
  - `Http/`: MVC components (controllers, models, views, forms)
  - `public/`: Web root with assets and entry point (`index.php`)
  
- **Key Framework Components**:
  - **Router** (`Core/Router.php`): Fluent API with middleware chaining
  - **Container** (`Core/Container.php`): Dependency injection container with `App::resolve()`
  - **Database** (`Core/Database.php`): PDO wrapper with method chaining
  - **Session** (`Core/Session.php`): Flash messages and session management
  - **Validator** (`Core/Validator.php`): Input validation with image upload support

- **Bootstrap Flow**: `public/index.php` → `bootstrap.php` → routes → controllers → views
  - Environment variables loaded via `vlucas/phpdotenv`
  - Container bindings for Database and config in `bootstrap.php`
  - Global ValidationException handling with redirect-after-POST pattern

## Frontend Stack

- **Alpine.js**: Primary JavaScript framework for reactivity
  - Load order: `main.js` → Alpine.js CDN (deferred)
  - Use `x-data`, `x-model`, `x-show` for component state
  - Global functions via `window.functionName = () => {}`
  
- **TailwindCSS v4**: Custom build process
  - Config: `public/styles/index.css` with `@import "tailwindcss"`
  - Build: `npm run dev` for development watch mode
  - Output: `public/dist/style.css`

- **FilterComponent Pattern** (`public/scripts/main.js`): 
  ```javascript
  // Reusable table filtering with Alpine.js integration
  FilterComponent.init('filterContainer', [
      ['field_name', 'Display Label'],
      ['another_field', 'Another Label']
  ], 'tableId');
  ```

## Development Workflows

### Environment Setup
```bash
# 1. Environment file
cp .env.example .env

# 2. Dependencies  
composer install
npm install

# 3. Build assets (watch mode)
npm run dev
```

### Database Configuration
```env
DATABASE_HOSTNAME=localhost
DATABASE_USERNAME=root
DATABASE_PASSWORD=
DATABASE_NAME=amadeus
```

## CRUD Implementation Pattern

**Complete CRUD requires 7 files** following this exact structure:

### 1. Routes (`routes.php`)
```php
$router->get('/resource', 'resource/index.php');
$router->patch('/resource', 'resource/update.php');  
$router->delete('/resource', 'resource/destroy.php');
```

### 2. Controllers (`Http/controllers/resource/`)
- `index.php`: Query with JOINs for display, load reference data for dropdowns
- `update.php`: Form validation → Model update → redirect
- `destroy.php`: Model destroy → redirect

```php
// Controllers always follow this pattern
use Core\App;
use Core\Database;

$db = App::resolve(Database::class);
$data = $db->query("SELECT * FROM table")->get();
require base_path('Http/views/resource/action.view.php');
```

### 3. Form Validation (`Http/forms/ResourceForm.php`)
```php
class ResourceForm extends Form {
    public function __construct($attributes) {
        $this->attributes = $attributes;
        // Validation rules using $this->error('field', 'message')
    }
}
```

### 4. Models (`Http/models/Resource.php`)
```php
class Resource {
    public function update(array $attributes): void {
        // Database update
        Session::flash('success', 'Message');
    }
    public function destroy(array $attributes): void {
        // Database delete  
        Session::flash('success', 'Message');
    }
}
```

### 5. Views (`Http/views/resource/`)
- `index.view.php`: Main table with FilterComponent integration
- `update.view.php`: Alpine.js modal with form fields
- `destroy.view.php`: Confirmation modal

## Critical Patterns

### Alpine.js Modal Pattern
```php
// Main container x-data
<main x-data="{showDeleteModal: false, deleteId: null, showUpdateModal: false, editData: null}">

// Modal trigger
<button @click="showUpdateModal=true; editData = <?= htmlspecialchars(json_encode($item)) ?>">

// Modal form bindings (NULL SAFETY CRITICAL)
:value="editData ? editData.field ?? '' : ''"
:selected="editData && editData.field == 'value'"
```

### Form Processing Flow
1. Form validates via `ResourceForm::validate($attributes)`
2. Throws `ValidationException` on failure → caught in `index.php` → redirected with flash
3. Success: Model method → `Session::flash()` → `redirect()`
4. `Session::unflash()` called automatically in `index.php`

### Database Query Patterns
```php
// Method chaining for single/multiple results
$db->query('SELECT * FROM table WHERE id = :id', ['id' => $id])->find();
$db->query('SELECT * FROM table')->get();

// Complex JOINs for display (see flight_schedules/index.php)
$db->query("
    SELECT fs.*, au.user as pilot_name, a.airline as airline_name
    FROM flight_schedules fs
    LEFT JOIN airline_users au ON fs.airline_user_id = au.id  
    LEFT JOIN airlines a ON au.airline_id = a.id
")->get();
```

### Dark Mode Text Pattern
All form inputs must include both light and dark text colors:
```css
class="...text-black dark:text-white..."
```

### Client-Side Filtering Setup
```php
// Table cells need data-field attributes  
<td data-field="field_name"><?= $data['field_name'] ?></td>

// JavaScript initialization in view
FilterComponent.init('filterContainer', [
    ['field_name', 'Display Name']
], 'tableId');
```

## Aviation Domain Schema
- `airlines` → `airline_users` (staff/admin/pilots)
- `airports` linked via `flight_routes` (origin/destination)
- `aircraft` assigned to routes
- `flight_schedules` link users to routes with varchar dates/times
- Foreign keys cascade on DELETE

## Common Pitfalls

1. **NULL Safety**: Always use `editData ? editData.field ?? '' : ''` in Alpine bindings
2. **Column Names**: Database uses `user` not `name` in `airline_users` table  
3. **Form Method Spoofing**: Use `<input type="hidden" name="_method" value="PATCH">` 
4. **Script Loading**: `main.js` must load before Alpine.js CDN
5. **Session Management**: `Session::unflash()` handled automatically in `index.php`
6. **Image Uploads**: Use `Validator::image()` → store in `public/uploads/`

## File Structure Conventions
- Controllers: Single action per file (`airlines/index.php`, `airlines/update.php`)
- Views: Match controller structure (`views/airlines/index.view.php`)  
- Models: Business logic in `Http/models/`
- Forms: Validation classes in `Http/forms/`
- Scripts: Reusable components in `public/scripts/`
