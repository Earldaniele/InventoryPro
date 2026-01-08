# Inventory System

Basic inventory management for tracking stock, suppliers, and reordering. Built with Laravel 10.

## What it does

- Track products and stock levels
- Low stock alerts  
- Supplier management
- Simple DSS for reorder suggestions (EOQ-based)

## Quick Start

Requires PHP 8.1+, Composer, MySQL.

```bash
composer install
cp .env.example .env
php artisan key:generate
```

Update `.env` with your DB creds:
```
DB_DATABASE=inventory_db
DB_USERNAME=root
DB_PASSWORD=
```

Then:
```bash
php artisan migrate
php artisan db:seed   # optional - adds test data
php artisan serve
```

For XAMPP just drop it in htdocs and hit `localhost/inventory`.

## Project Structure

Standard Laravel stuff:
- Models in `app/Models`
- Controllers in `app/Http/Controllers`  
- Views in `resources/views`

The DSS service (`app/Services/InventoryDSSService.php`) handles the reorder calculations - EOQ, safety stock, priority scoring, etc.

## Notes

- EOQ uses a hardcoded $50 ordering cost - should probably make that configurable at some point
- Supplier lead times default to 7 days if not set
- Safety stock = max(2x daily consumption, min stock level)
- Priority scoring is a bit arbitrary, might need tuning based on actual usage

## Known Issues

- Pagination breaks if you filter by category on the products page (haven't fixed this yet)
- The consumption chart doesn't handle products with no transaction history gracefully

## TODO

- [ ] User auth (maybe Laravel Breeze?)
- [ ] CSV export  
- [ ] Email alerts for critical stock
- [ ] Better mobile support
- [ ] Actual unit tests...

---
MIT License
