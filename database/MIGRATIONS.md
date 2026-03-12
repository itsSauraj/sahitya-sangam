# Database Migrations Guide

Complete guide for managing database migrations in Sahitya Sangam.

## 📋 Table of Contents

1. [What are Migrations?](#what-are-migrations)
2. [Migration Files Structure](#migration-files-structure)
3. [How to Use](#how-to-use)
4. [Creating Migrations](#creating-migrations)
5. [Running Migrations](#running-migrations)
6. [Rolling Back](#rolling-back)
7. [Seeding Data](#seeding-data)
8. [Best Practices](#best-practices)

---

## What are Migrations?

Migrations are version control for your database. They allow you to:
- ✅ Define database structure in code
- ✅ Track changes over time
- ✅ Share schema changes with team
- ✅ Rollback changes if needed
- ✅ Keep all environments in sync

## Migration Files Structure

```
database/
├── migrate.php              # Migration runner script
├── seed.php                 # Database seeder
├── migrations/              # Migration SQL files
│   ├── 20260312000001_create_users_table.sql
│   ├── 20260312000002_create_books_table.sql
│   ├── 20260312000003_create_orders_table.sql
│   └── ...
└── seeds/                   # Seed data files (optional)
```

### Migration File Format

Each migration file has two sections:

```sql
-- Migration: Description
-- Created: Date

-- UP
-- SQL to apply changes (CREATE, ALTER, INSERT, etc.)
CREATE TABLE example (...);

-- DOWN
-- SQL to revert changes (DROP, ALTER back, DELETE, etc.)
DROP TABLE IF EXISTS example;
```

---

## How to Use

### Prerequisites

1. Ensure you're in the project root:
   ```powershell
   cd C:\xampp\htdocs\Sahitya_Sangam2
   ```

2. XAMPP MySQL must be running

3. Database `sahitya_db` should exist:
   ```sql
   CREATE DATABASE sahitya_db;
   ```

---

## Creating Migrations

### Option 1: Use the Generator

```powershell
php database/migrate.php create CreateProductsTable
```

This creates a timestamped file:
```
database/migrations/20260312141530_CreateProductsTable.sql
```

### Option 2: Create Manually

1. Create file with format: `YYYYMMDDHHmmss_description.sql`
2. Add UP and DOWN sections

**Example**: `20260312141530_add_rating_to_books.sql`

```sql
-- Migration: Add rating column to books
-- Created: 2026-03-12 14:15:30

-- UP
ALTER TABLE books 
ADD COLUMN rating DECIMAL(3, 2) DEFAULT 0.00,
ADD COLUMN review_count INT DEFAULT 0;

-- DOWN
ALTER TABLE books 
DROP COLUMN rating,
DROP COLUMN review_count;
```

---

## Running Migrations

### Check Migration Status

See which migrations are pending:

```powershell
php database/migrate.php status
```

**Output:**
```
Migration Status:
======================================================================

Executed Migrations:
  ✓ 20260312000001_create_users_table.sql
  ✓ 20260312000002_create_books_table.sql

Pending Migrations:
  • 20260312000003_create_orders_table.sql
  • 20260312000004_create_order_items_table.sql

======================================================================
Total: 6 | Executed: 2 | Pending: 4
```

### Run All Pending Migrations

```powershell
php database/migrate.php up
```

**Output:**
```
Running 4 migration(s)...

→ Migrating: 20260312000003_create_orders_table.sql
✓ Migrated:  20260312000003_create_orders_table.sql

→ Migrating: 20260312000004_create_order_items_table.sql
✓ Migrated:  20260312000004_create_order_items_table.sql

...

✓ All migrations completed successfully!
```

---

## Rolling Back

### Rollback Last Migration

```powershell
php database/migrate.php down
```

### Rollback Multiple Migrations

Rollback last 3 migrations:

```powershell
php database/migrate.php down 3
```

### When to Rollback?

- ❌ Migration created wrong structure
- ❌ Need to modify a column
- ❌ Testing migration changes
- ⚠️ **Warning**: Only rollback in development! Production rollbacks can lose data.

---

## Seeding Data

After running migrations, populate with sample data:

```powershell
php database/seed.php
```

**What it seeds:**
- ✅ 5 sample authors
- ✅ 5 sample books with prices
- ✅ 1 test user (test@sahityasangam.com / password123)

---

## Best Practices

### ✅ Do's

1. **Always test locally first**
   ```powershell
   php database/migrate.php status  # Check first
   php database/migrate.php up      # Then run
   ```

2. **Write both UP and DOWN**
   - Every UP should have a DOWN
   - Test rollbacks work

3. **Use descriptive names**
   ```
   ✅ create_users_table.sql
   ✅ add_status_to_orders.sql
   ❌ migration1.sql
   ```

4. **One change per migration**
   ```
   ✅ 001_create_users.sql
   ✅ 002_create_books.sql
   ❌ 001_create_all_tables.sql
   ```

5. **Never edit executed migrations**
   - Create a new migration instead
   - Editing can break production

### ❌ Don'ts

1. **Don't delete migrations after running**
   - Keep all migration files
   - They're your database history

2. **Don't run migrations directly in MySQL**
   - Always use `migrate.php`
   - It tracks what's been run

3. **Don't skip DOWN section**
   - You'll need it to rollback
   - Even if you think you won't

4. **Don't mix UP and DOWN logic**
   ```sql
   -- ❌ Bad
   -- UP
   CREATE TABLE users (...);
   DROP TABLE old_users;
   
   -- ✅ Good (separate migrations)
   -- UP
   CREATE TABLE users (...);
   ```

---

## Common Workflows

### Starting Fresh (Clean Database)

```powershell
# Run all migrations
php database/migrate.php up

# Add sample data
php database/seed.php
```

### Adding a New Feature

```powershell
# 1. Create migration
php database/migrate.php create AddDiscountToBooks

# 2. Edit the file in database/migrations/

# 3. Run migration
php database/migrate.php up

# 4. Check status
php database/migrate.php status
```

### Fixing a Bad Migration

```powershell
# 1. Rollback
php database/migrate.php down

# 2. Fix the migration file

# 3. Run again
php database/migrate.php up
```

### Production Deployment

```powershell
# 1. Check what will run
php database/migrate.php status

# 2. Backup database first!
mysqldump -u root sahitya_db > backup.sql

# 3. Run migrations
php database/migrate.php up

# 4. Verify
php database/migrate.php status
```

---

## Troubleshooting

### Error: "Connection failed"

**Problem**: Can't connect to database

**Solution**:
1. Check XAMPP MySQL is running
2. Verify credentials in `includes/config/db.php`
3. Ensure database exists: `CREATE DATABASE sahitya_db;`

### Error: "Table already exists"

**Problem**: Running migration that creates existing table

**Solution**:
```powershell
# Check which migrations already ran
php database/migrate.php status

# The existing table might have been created manually
# Either: Drop the table, or mark migration as executed in migrations table
```

### Error: "Foreign key constraint fails"

**Problem**: Migration order is wrong (child before parent)

**Solution**:
- Rename migration files to correct order
- Parent tables first (users, books)
- Then child tables (orders, order_items)

### Want to Reset Everything?

```powershell
# ⚠️ WARNING: Deletes all data!

# In MySQL:
DROP DATABASE sahitya_db;
CREATE DATABASE sahitya_db;

# Then run migrations:
php database/migrate.php up
php database/seed.php
```

---

## Migration Tracking

Migrations are tracked in the `migrations` table:

```sql
SELECT * FROM migrations;
```

**Output:**
| id  | migration                              | batch | executed_at         |
|-----|----------------------------------------|-------|---------------------|
| 1   | 20260312000001_create_users_table.sql  | 1     | 2026-03-12 10:00:00 |
| 2   | 20260312000002_create_books_table.sql  | 1     | 2026-03-12 10:00:01 |
| 3   | 20260312000003_create_orders_table.sql | 2     | 2026-03-12 11:30:00 |

- **batch**: Groups migrations run together
- Rollback operates on batches

---

## Example: Complete Migration Lifecycle

```powershell
# 1. Check status
php database/migrate.php status
# Output: 2 pending migrations

# 2. Run migrations
php database/migrate.php up
# Output: Successfully migrated 2 files

# 3. Realize you made a mistake
php database/migrate.php down
# Output: Rolled back last batch

# 4. Fix the migration file
# Edit: database/migrations/20260312000003_create_orders_table.sql

# 5. Run again
php database/migrate.php up
# Output: Successfully migrated

# 6. Seed data
php database/seed.php
# Output: Added 5 books, 5 authors, 1 test user

# 7. Verify
php database/migrate.php status
# Output: All migrations executed
```

---

## Next Steps

1. ✅ Run initial migrations: `php database/migrate.php up`
2. ✅ Seed sample data: `php database/seed.php`
3. ✅ Test with browser: `http://localhost/Sahitya_Sangam2/`
4. ✅ Create new migrations as needed

---

**Questions?** Check the troubleshooting section or contact the dev team.
