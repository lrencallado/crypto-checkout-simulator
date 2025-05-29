# 🚀 Crypto Checkout Simulator (PHP, Laravel)

This project simulates a backend service for a crypto-based event ticket checkout using Laravel. It mocks the behavior of Coinbase Commerce and demonstrates basic webhook integration.

---

## 📦 Features

- `POST /api/v1/checkout` – Create a fake checkout session
- `POST //webhook` – Handle simulated Coinbase webhook payloads
- `/up` - Laravel includes a built-in health check route that can be used to monitor the status of your application
- `/pulse` - Laravel built-in pulse delivers at-a-glance insights of application's performance and usage. Track down bottlenecks like slow jobs and endpoints, find your most active users, and more.
- Input validation via Laravel FormRequest
- Mocked Coinbase payment URL
- Stores transactions in a MySQL database

---

## ▶️ How to Run

1. Clone the repository
    ```bash
    git clone https://github.com/lrencallado/crypto-checkout-simulator.git
    ```
2. Navigate to the project directory
    ```bash
    cd crypto-checkout-simulator
    ```
3. Install dependencies using Composer
    ```bash
    composer install
    ```
4. Copy the `.env.example` file to `.env` (if not existing):
    ```bash
    cp .env.example .env
    ```
5. Update the `.env` file with your database credentials:
    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_user
    DB_PASSWORD=your_database_password
    ```
6. Generate the application key:
    ```bash
    php artisan key:generate
    ```
7. Run database migrations:
    ```bash
    php artisan migrate
    ```

---

## Testing

1. Run the test:
    ```bash
    php artisan test --filter test_checkout_endpoint
    ```

---

## 📐 Assumptions Made

### ✅ Repository and Service Pattern

- **Why?** For better separation of concerns and cleaner code.
- **Advantages:**
  - Easier to test and maintain.
  - Isolates business logic from controllers.
  - Flexible for feature expansion.
  - The Repository Pattern acts as a bridge between the business logic and the data layer (usually a database). It centralizes data access logic, making the application easier to test, maintain, and extend.

### ✅ API Versioning (`Api\V1`)

- Organizes controllers in a versioned folder structure (`Api/V1`) to prepare for future API iterations.
- Simplifies long-term maintenance and supports backward compatibility.

### ✅ Validated Requests

- Form Requests (`CheckoutRequest`) ensure clean, centralized input validation.
- Keeps controllers slim and focused.

### ✅ Simulated Coinbase API Integration

- Coinbase interactions are mocked, returning fake URLs and responses.
- Webhooks simulate a real payment status change from Coinbase.

### ✅ amount column uses BIGINT

- In real-world payment systems, it’s a best practice to store monetary values in the smallest currency unit
- This avoids floating-point rounding issues and ensures arithmetic precision.
- Most payment gateways operate using integer-based currency units to eliminate decimal inaccuracies.

---

## 🛠 Potential Improvements

- Admin panel for manually retrying failed jobs
    - This will include Users and Roles management and login
- Improve api routes versioning (if needed)

---
