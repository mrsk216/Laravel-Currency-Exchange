# Laravel Currency Exchange Form

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
[![Laravel](https://img.shields.io/badge/Laravel-10.x-orange.svg)](https://laravel.com/docs/10.x)
[![PHP](https://img.shields.io/badge/PHP-8.1+-blue.svg)](https://www.php.net/)

## Description

This is a simple, user-friendly web application built with Laravel for performing real-time currency exchanges. It allows users to input an amount in their base currency (default: USD), select a target currency from a dropdown, and instantly view the converted amount without any page reloads. The app leverages AJAX for a seamless frontend experience and fetches live exchange rates from the free [ExchangeRate-API](https://www.exchangerate-api.com/) (v6 endpoint).

Key highlights:
- **No database required**: Purely API-driven for lightweight setup.
- **Responsive design**: Works on desktop and mobile.
- **Easy customization**: Modify currencies, styling, or add more features as needed.

This project is ideal for beginners learning Laravel with AJAX integration or for quick prototypes in fintech demos.

## Features

- **Real-time Conversion**: Enter an amount and get instant exchange rates.
- **Currency Selection**: Dropdown for base and target currencies (pre-populated with common ones like USD, EUR, GBP, JPY, etc.).
- **AJAX-Powered**: Smooth updates without full page refreshes.
- **Error Handling**: Graceful fallbacks for API failures or invalid inputs.
- **Extensible**: Easy to add more currencies or integrate with other APIs.

## How It Works

### High-Level Overview
1. **Frontend (Blade + JavaScript)**:
   - A simple form with input fields for amount and select boxes for currencies.
   - JavaScript (vanilla or jQuery) listens for input changes and sends an AJAX request to the Laravel backend.
   - The response (JSON) updates the display with the converted amount.

2. **Backend (Laravel)**:
   - A dedicated route (e.g., `/exchange`) handles POST requests.
   - The controller uses Guzzle (or cURL) to query the ExchangeRate-API endpoint: `https://v6.exchangerate-api.com/v6/{API_KEY}/latest/{BASE_CURRENCY}`.
   - It calculates the conversion (e.g., `amount * exchange_rate`) and returns JSON.

3. **API Integration**:
   - Free tier supports up to 1,500 requests/month.
   - Rates are updated every 60 seconds for accuracy.
   - Example API call: Fetches latest rates for the base currency and extracts the rate for the target.

### Architecture Flow
```
User Input (Amount + Currencies) → AJAX Request → Laravel Route/Controller → API Call → JSON Response → UI Update
```

For a deeper dive, check the code:
- **Views**: `resources/views/exchange.blade.php` (form template).
- **Routes**: `routes/web.php` (API endpoint).
- **Controller**: `app/Http/Controllers/ExchangeController.php` (handles logic).
- **JavaScript**: `public/js/exchange.js` (AJAX handler).

## Quick Start (For Users)

If you're just testing the app:

1. **Clone the Repository**:
   ```
   git clone https://github.com/mrsk216/laravel-currency-exchange.git
   cd laravel-currency-exchange
   ```

2. **Set Up Environment**:
   - Copy the example environment file: `cp .env.example .env`
   - Generate an app key: `php artisan key:generate`

3. **Install Dependencies**:
   - Composer (PHP packages): `composer install --optimize-autoloader --no-dev`
   - NPM (for assets): `npm install && npm run build` (or `npm run dev` for development)

4. **Get an API Key**:
   - Sign up for a free account at [ExchangeRate-API](https://www.exchangerate-api.com/signup).
   - Add your key to `.env`: `EXCHANGE_API_KEY=your_api_key_here`

5. **Run the App**:
   ```
   php artisan serve
   ```
   - Open [http://localhost:8000](http://localhost:8000) in your browser.
   - Enter an amount (e.g., 100), select currencies (e.g., From: USD, To: EUR), and watch the magic!

**Troubleshooting**:
- If rates don't load, check your API key and internet connection.
- Clear cache: `php artisan config:clear && php artisan cache:clear`.

## Installation for Developers

This section is for contributors or those customizing the code. Assumes basic knowledge of Laravel.

### Prerequisites
- **PHP**: 8.1 or higher.
- **Composer**: For PHP dependencies.
- **Node.js & NPM**: For frontend assets (Vite-based).
- **Git**: For cloning.
- **Web Server**: Built-in `php artisan serve` works for dev; use Apache/Nginx for production.
- **Optional**: A database (SQLite/MySQL) if you extend with user history (not required here).

### Step-by-Step Setup
1. **Clone the Repo**:
   ```
   git clone https://github.com/mrsk216/laravel-currency-exchange.git
   cd laravel-currency-exchange
   ```

2. **Environment Configuration**:
   ```
   cp .env.example .env
   php artisan key:generate
   ```
   - Edit `.env`:
     ```
     EXCHANGE_API_KEY=your_free_api_key_here
     APP_URL=http://localhost:8000
     ```
     (Get the key from [ExchangeRate-API](https://www.exchangerate-api.com/). Free tier is sufficient.)

3. **Install Dependencies**:
   ```
   composer install
   npm install
   npm run build  # For production; use 'npm run dev' for hot-reloading in dev
   ```

4. **Database Setup** (Optional, if extending):
   - Configure `.env` with your DB details (e.g., `DB_CONNECTION=sqlite` for quick setup).
   - Run migrations: `php artisan migrate` (no migrations in base project).

5. **Start the Server**:
   ```
   php artisan serve
   ```
   - Access at [http://localhost:8000](http://localhost:8000).

6. **For Production**:
   - Set `APP_ENV=production` in `.env`.
   - Optimize: `php artisan config:cache && php artisan route:cache && php artisan view:cache`.
   - Deploy to a host like Heroku, Forge, or Vapor.
   - Ensure HTTPS for API calls.

### Customization Tips
- **Add Currencies**: Edit the select options in `exchange.blade.php` and update the controller to validate them.
- **Styling**: Uses Tailwind CSS (via Vite). Modify `resources/css/app.css`.
- **Error Logging**: Add try-catch in the controller for API failures.
- **Testing**: Run `php artisan test` (add tests in `tests/Feature/` for the exchange endpoint).
- **Extend with Auth**: Use Laravel Breeze/Sanctum for user-specific rate history.

## API Reference
- **Endpoint**: `POST /exchange`
- **Request Body**:
  ```json
  {
    "amount": 100,
    "from": "USD",
    "to": "EUR"
  }
  ```
- **Response**:
  ```json
  {
    "success": true,
    "converted_amount": 92.5,
    "rate": 0.925,
    "message": "Conversion successful"
  }
  ```
- Full docs: See [ExchangeRate-API Documentation](https://www.exchangerate-api.com/docs-free).

**Rate Limits**: Free plan: 1,500 requests/month. Upgrade for more.

## Contributing

Contributions are welcome! Fork the repo, create a feature branch (`git checkout -b feature/amazing-feature`), and submit a Pull Request.

1. Fork the project.
2. Clone your fork: `git clone https://github.com/mrsk216/laravel-currency-exchange.git`.
3. Create a branch: `git checkout -b my-feature`.
4. Commit changes: `git commit -m 'Add some feature'`.
5. Push: `git push origin my-feature`.
6. Open a PR!

Please follow Laravel coding standards and add tests for new features.

## License

This project is open-sourced under the [MIT License](LICENSE). Feel free to use, modify, and distribute.

## Acknowledgments
- [Laravel Framework](https://laravel.com/) for the robust backend.
- [ExchangeRate-API](https://www.exchangerate-api.com/) for free exchange rates.
- Built with ❤️ for the developer community.

---

*Last Updated: September 27, 2025*  
Questions? Open an issue on GitHub or reach out via email (freelancersk216@gmail.com). Happy coding! 🚀