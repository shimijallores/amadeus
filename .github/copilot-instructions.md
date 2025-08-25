# Amadeus AI Agent Instructions

This document guides AI agents working in the Amadeus Global Distribution System codebase. Follow these patterns when making changes.

## Project Architecture

- **MVC Structure**: Custom MVC framework with Core system classes and Http components
  - `Core/`: Framework classes (Router, Container, Database, etc)
  - `Http/`: MVC components (controllers, models, views)
  - `public/`: Web root with assets and entry point
  
- **Key Components**:
  - **Router** (`Core/Router.php`): Routes requests to controllers, handles HTTP methods
  - **Container** (`Core/Container.php`): Dependency injection container for services
  - **Database** (`Core/Database.php`): PDO wrapper for DB operations
  - **Session** (`Core/Session.php`): Manages session state and flash messages
  - **Forms** (`Http/forms/`): Form validation and processing
  - **Middleware** (`Core/Middleware/`): Auth and request filtering

## Development Workflows

### Environment Setup
1. Copy `.env.example` to `.env` and configure:
   ```env
   DATABASE_HOSTNAME=localhost
   DATABASE_USERNAME=your_db_user
   DATABASE_PASSWORD=your_db_password
   DATABASE_NAME=your_db_name
   ```

2. Install dependencies:
   ```bash
   composer install
   npm install
   ```

3. Build assets:
   ```bash
   npm run dev # For development CSS build
   ```

### Adding New Features

1. **Routes**: Add to `routes.php` using the Router's fluent API:
   ```php
   $router->get('/path', 'controller/action.php');
   $router->post('/path', 'controller/action.php')->only('admin');
   ```

2. **Forms**: Extend `Http/forms/Form.php` for validation:
   ```php 
   class NewForm extends Form {
       public function __construct($attributes) {
           // Add validation rules using Core\Validator
       }
   }
   ```

3. **Controllers**: Follow pattern in `Http/controllers/`:
   - Single responsibility files
   - Use models for business logic
   - Flash session messages for user feedback

4. **Models**: Place in `Http/models/` with standard CRUD operations

## Common Patterns

### Authentication
- Uses `Core/Middleware/Admin.php` for protected routes
- Session-based auth with `Core/Session.php`
- Login flow in `Http/controllers/login/`

### Form Processing
1. Validate input with Form classes
2. Handle files with `Validator::image()`
3. Flash errors to session if validation fails
4. Redirect after successful processing

### Database Operations
- Use `Core\Database` for queries:
  ```php
  $db->query('SELECT * FROM table WHERE id = :id', ['id' => $id])->find();
  ```
- Models handle business logic and complex queries
- Use prepared statements for all queries

## Integration Points

- **Frontend**: TailwindCSS for styling
- **JavaScript**: Alpine.js for interactivity
- **File Uploads**: Handled in `public/uploads/` directory
- **Email**: PHPMailer integration available

## Project Conventions

- Use validation before DB operations
- Flash messages for user feedback
- RESTful route naming
- Controller files follow single action pattern
- Middleware for auth checks

## Common Pitfalls

1. Always validate file uploads with `Validator::image()`
2. Remember to call `Session::unflash()` after redirects
3. Use `redirect()` after POST/PATCH/DELETE operations
4. Check auth state with proper middleware
5. Sanitize user input before database operations
