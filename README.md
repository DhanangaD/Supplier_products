# Supplier Products System

## Description
A simple system to manage suppliers and their products using Laravel for the backend and Vue.js for the frontend.

## Installation

### Backend (Laravel)
1. Clone the repository.
2. Navigate to the `backend` directory.
3. Run `composer install`.
4. Set up your `.env` file with relevant database name and type.
5. Run `php artisan migrate --seed`.
6. Run `php artisan serve`.

### Frontend (Vue.js)
1. Navigate to the `frontend` directory.
2. Run `npm install`.
3. Run `npm run serve`.

## Usage
- Use the "Add Supplier" page to add suppliers and their products.
- When user added Supplier successfully, page redirect to the all suppliers.
- Use the "Supplier List" page to search and view suppliers with 20 records pagination.
- Also do "Edit" and "Delete" suppliers in that page.
