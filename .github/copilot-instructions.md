# Amadeus AI Agent Instructions

This document guides AI agents working in the Amadeus Global Distribution System codebase. Follow these patterns when making changes.

## Project Architecture

- **Custom MVC Framework**: No Laravel/Symfony - everything is custom-built
  - `Core/`: Framework classes (Router, Container, Database, Session, Validator)  
  - `Http/`: MVC components (controllers, models, views, forms)
  - `public/`: Web root with assets and entry point (`index.php`)
  
- **Key Framework Components**:
  - **Router** (`Core/Router.php`): Fluent API with middleware chaining
  - **Container** (`Core/Container.php`): Dependency injection container
  - **Database** (`Core/Database.php`): PDO wrapper with method chaining
  - **Session** (`Core/Session.php`): Flash messages and session management
  - **Validator** (`Core/Validator.php`): Input validation with image upload support

## Frontend Stack

- **Alpine.js**: Primary JavaScript framework for reactivity
  - Load order: `main.js` → Alpine.js CDN (deferred)
  - Use `x-data`, `x-model`, `x-show` for component state
  - Global functions via `window.functionName = () => {}`
  
- **TailwindCSS v4**: Custom build process
  - Config: `public/styles/index.css` with `@import "tailwindcss"`
  - Build: `npm run dev` for development watch mode
  - Output: `public/dist/style.css`

- **Dynamic Components Pattern**: 
  ```javascript
  // public/scripts/main.js
  const FilterComponent = {
      init(containerId, fields, tableId) { /* ... */ },
      generateFilterForm() { /* Alpine.js integration */ }
  };
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

### Adding Features

1. **Routes** (`routes.php`): Method chaining with middleware
   ```php
   $router->get('/airlines', 'airlines/index.php');
   $router->patch('/airlines', 'airlines/update.php')->only('admin');
   ```

2. **Controllers**: Single-action files in `Http/controllers/`
   ```php
   use Core\App;
   use Core\Database;
   
   $db = App::resolve(Database::class);
   $data = $db->query("SELECT * FROM table")->get();
   require base_path('Http/views/resource/action.view.php');
   ```

3. **Views**: Include partials, use Alpine.js for interactivity
   ```php
   <main x-data="{showModal: false, editData: null}">
   ```

## Critical Patterns

### Alpine.js Integration
- **Modal Pattern**: `x-show="showModal"` with `x-transition`
- **Data Binding**: `:value="editData ? editData.field ?? '' : ''"`  
- **Event Handling**: `@click="showModal=true; editData = <?= json_encode($data) ?>"`
- **Component State**: Always initialize data in main container's `x-data`

### Form Processing
1. Extend `Http/forms/Form.php` for validation
2. Use `Validator::image()` for file uploads → `public/uploads/`
3. Flash errors: `Session::flash('errors', $errors)`
4. Redirect after POST/PATCH/DELETE operations

### Database Operations  
```php
// Method chaining pattern
$db->query('SELECT * FROM table WHERE id = :id', ['id' => $id])->find();
$db->query('INSERT INTO table (field) VALUES (:field)', $params);
```

### Client-Side Filtering
- **Table Structure**: Add `data-field="fieldname"` to `<td>` elements
- **Filter Component**: Initialize via `FilterComponent.init(containerId, fields, tableId)`
- **Dynamic Forms**: Checkbox-controlled input enabling with Alpine.js reactivity

## Common Pitfalls

1. **Alpine.js Template Literals**: Avoid complex `${}` in `x-data` - use closure variables
2. **Script Loading**: `main.js` must load before Alpine.js
3. **Null Safety**: Always use `editData ? editData.field ?? '' : ''` in Alpine bindings
4. **File Uploads**: Validate with `Validator::image()`, store in `public/uploads/`
5. **Session Management**: Call `Session::unflash()` after redirects (handled in `index.php`)

## File Structure Conventions
- Controllers: Single action per file (`airlines/index.php`, `airlines/update.php`)
- Views: Match controller structure (`views/airlines/index.view.php`)  
- Models: Business logic in `Http/models/`
- Forms: Validation classes in `Http/forms/`
- Scripts: Reusable components in `public/scripts/`
