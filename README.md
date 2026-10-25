# Innocean Bakery - Data Entry
A form to submit a name, store, and product. The product list depends on the tier of the selected store. The submitted data will be shown in a table.

## Tech Stack
- Frontend: Vue 3
- Backend: Laravel
- Database: PostgreSQL

## Requirements
- PHP 8.3+ with `pdo_pgsql` and `pgsql` extensions enabled
- Composer
- Node.js 20.19+ (or 22.12+) and npm
- PostgreSQL 14+ (tested on 18.4)

## Setup
1. Install Dependencies
```
composer install
npm install
```
2. Create the database in PostgreSQL (psql or pgAdmin)
```sql
CREATE DATABASE innocean_bakery;
```
3. Configure environment
```powershell
cp .env.example .env
php artisan key:generate
```
Then set `DB_USERNAME` and `DB_PASSWORD` in `.env`.
4. Run migrations and seed the reference data (3 tiers, 10 stores, 15 products)
```
php artisan migrate --seed
```

## Run
Open two terminals:
```
php artisan serve
```
```
npm run dev
```
Open http://127.0.0.1:8000 

## Database Design
- `tiers` (id, name) - Tier A / B / C
- `stores` (store_id PK, store_name, address, city, province, tier_id FK)
- `products` (product_id PK, product_name, category, tier_id FK, recommended_price_IDR)
- `submissions` (id, name, store_id FK, product_id FK)

One tier has many stores and many products. A store may only be combined with products
of the same tier. This rule is validated on the server as well, not only in the UI.

## API
| Method | Endpoint | Description |
|---|---|---|
| GET | `/api/stores` | All stores |
| GET | `/api/stores/{store}/products` | Products available for the store's tier |
| GET | `/api/submissions` | All submitted entries |
| POST | `/api/submissions` | Save an entry (`name`, `store_id`, `product_id`) |

Mismatched tier returns `422`.

## Dataset 
Reference data (stores and product catalog) comes from the spreadsheet provided with the assessment and is loaded by the seeders in `database/seeders`.