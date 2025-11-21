# Amadeus - A Global Distribution System

A global distribution system for managing airline operations, including airlines, airports, aircraft, flight routes, and schedules with role-based access control.

## Features

- **Airline Management**: CRUD operations for airlines, airports, and aircraft
- **Flight Operations**: Manage flight routes and schedules
- **User Management**: Role-based access (Admin, Staff, User)
- **Seat Management**: View and manage flight seat layouts
- **Excel Import/Export**: Bulk data operations using PhpSpreadsheet
- **Responsive UI**: Built with Tailwind CSS and Alpine.js

## Tech Stack

- **Backend**: PHP 8+, MySQL, PDO
- **Frontend**: Tailwind CSS, Alpine.js
- **Dependencies**: Composer (PHP), NPM (CSS/JS)
- **Architecture**: Custom MVC framework with dependency injection

## Installation

1. **Clone the repository**:

   ```bash
   git clone https://github.com/shimijallores/amadeus.git
   cd amadeus
   ```

2. **Install PHP dependencies**:

   ```bash
   composer install
   ```

3. **Install Node.js dependencies**:

   ```bash
   npm install
   ```

4. **Set up environment**:

   - Copy `.env.example` to `.env` and configure database settings
   - Import `database/database.sql` into your MySQL database

5. **Build assets**:
   ```bash
   npm run dev
   ```

## Usage

1. **Start the development server**:

   ```bash
   php -S localhost:8000 -t public/
   ```

2. **Access the application**:

   - Open `http://localhost:8000` in your browser
   - Default admin login: username `admin`, password as set in database

3. **Roles**:
   - **Admin**: Full access to all features
   - **Staff**: Limited to their airline's data
   - **User**: Read-only access

## Project Structure

```
amadeus/
├── Core/                 # Framework core (Router, Database, etc.)
├── Http/
│   ├── controllers/      # Route controllers
│   ├── models/          # Data models
│   ├── forms/           # Validation forms
│   ├── views/           # Templates
│   └── Services/        # Business logic
├── public/              # Web root
├── database/            # SQL schema
├── vendor/              # Composer dependencies
└── node_modules/        # NPM dependencies
```

## Development

- **CSS Watch**: `npm run dev` (auto-compiles Tailwind)
- **Database**: Update `database/database.sql` for schema changes
- **Testing**: Manual testing recommended; no automated tests implemented

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Submit a pull request

## License

This project is licensed under the MIT License.
