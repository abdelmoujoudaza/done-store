# About Done Store

## Overview
A modern product management system built with Laravel, Vue.js, and Inertia.js that allows product creation through both web interface and CLI command. The system is fully containerized using Laravel Sail and includes comprehensive unit tests.

## Technical Stack
- **Backend**: Laravel 12.x
- **Frontend**: Vue.js 3, Inertia.js
- **Database**: MySQL 8
- **Testing**: Pest
- **Containerization**: Laravel Sail (Docker)
- **CI/CD**: GitHub Actions

## Features

### 1. Product Management
- Create/Read/Delete products
- Product categories with many-to-many relationships
- Image upload handling

### 2. Dual Creation Methods
**Web Interface:**
- Vue.js/Inertia.js powered SPA
- Form validation

**CLI Command**
- Create products via artisan command

### 3. Testing Coverage
- **Feature Tests**: 90%+ coverage
  - Product CRUD
  - CLI command
  - Vue components

## Development Setup

### Prerequisites
- Docker
- Node.js 20+
- PHP 8.2+
- Composer

### Using Laravel Sail
```bash
# Clone repository
git clone https://github.com/abdelmoujoudaza/done-store.git
cd done-store

# Install dependencies
composer install
npm install

# Start containers
./vendor/bin/sail up -d

# Run migrations
./vendor/bin/sail artisan migrate --seed

# Run tests
./vendor/bin/sail test
```

### Environment Configuration
```env
APP_ENV=local
DB_HOST=mysql
DB_DATABASE=done_store
DB_USERNAME=sail
DB_PASSWORD=password
```

### CLI Command
```bash
# Create single product
./vendor/bin/sail artisan products:create "Product name" "Product description" 19.99 ./path/to/image "categoryID,categoryID,..."

```

## Testing

```bash
# Run all tests
./vendor/bin/sail test
```

## Deployment
The system is configured for deployment to any Laravel-compatible hosting with:
- Automated CI/CD pipeline
- Database migrations
- Asset compilation

## Maintenance
```bash
# Update dependencies
./vendor/bin/sail composer update
./vendor/bin/sail npm update

# Clear caches
./vendor/bin/sail artisan optimize:clear
```
