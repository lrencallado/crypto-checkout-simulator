# 🚀 Crypto Checkout Simulator (PHP, Laravel)

This project simulates a backend service for a crypto-based event ticket checkout using Laravel. It mocks the behavior of Coinbase Commerce and demonstrates basic webhook integration.

---

## 📦 Features

- `POST /api/v1/checkout` – Create a fake checkout session
- `POST /api/v1/webhook` – Handle simulated Coinbase webhook payloads
- Input validation via Laravel FormRequest
- Mocked Coinbase payment URL
- Stores transactions in a MySQL database

---

## ▶️ How to Run

1. Clone the repository
    ```bash
    git clone https://github.com/lrencallado/crypto-checkout-simulator.git
    cd crypto-checkout-simulator
    ```
2. Navigate to the project directory
    ```bash
    cd crypto-checkout-simulator
    ```
3. Install dependencies using Composer
    ```bash
    composer install
    ```
4. Copy the `.env.example` file to `.env`:
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

## Testing

1. Run the test:
    ```bash
    php artisan test --filter test_checkout_endpoint
    ```
