# Supplier Products System

## Description
A simple system to manage suppliers and their products using Laravel for the backend and Vue.js for the frontend.

## Installation

### Backend (Laravel)
1. Clone the repository `backend` branch.
2. Run `composer install`.
3. Set up your `.env` file with relevant database name and type.
4. Run `php artisan migrate --seed`.
5. Run `php artisan serve`.

### Frontend (Vue.js)
1.  Clone the repository `frontend` branch.
2. Run `npm install`.
3. Run `npm run serve`.

## Usage
- Use the "Add Supplier" page to add suppliers and their products.
- When user added Supplier successfully, page redirect to the all suppliers.
- Use the "Supplier List" page to search and view suppliers with 20 records pagination.
- Also do "Edit" and "Delete" suppliers in that page.
