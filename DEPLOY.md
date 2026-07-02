# Deploying Emergency Incident Report to Railway

## Before You Deploy — Required Code Changes

### Step 1: Update all connect.php files
Replace the hardcoded credentials in these 3 files with environment variable reads:
- `portal/admin/includes/connect.php`
- `portal/agency/includes/connect.php`
- `portal/users/includes/connect.php`

Replace the top section of each with:
```php
$db_host     = getenv('DB_HOST')     ?: 'localhost';
$db_user     = getenv('DB_USER')     ?: 'root';
$db_pass     = getenv('DB_PASS')     ?: '';
$db_database = getenv('DB_NAME')     ?: 'db_ems';
```

### Step 2: Fix config.php (uses removed function)
In `portal/admin/includes/config.php`, replace the entire file content with:
```php
<?php
$db_host     = getenv('DB_HOST')     ?: 'localhost';
$db_user     = getenv('DB_USER')     ?: 'root';
$db_pass     = getenv('DB_PASS')     ?: '';
$db_database = getenv('DB_NAME')     ?: 'db_ems';

$conn = mysqli_connect($db_host, $db_user, $db_pass)
    or die("Could not connect to database");
mysqli_select_db($conn, $db_database)
    or die("Could not select database");
```

### Step 3: Add nixpacks.toml to your repo root
Copy the `nixpacks.toml` file provided alongside this guide to the root of your repository.
This tells Railway how to run your PHP project.

---

## Railway Deployment Steps

### 1. Push your code to GitHub
```bash
git add .
git commit -m "Add Railway deployment config"
git push
```

### 2. Create a Railway account
Go to https://railway.app and sign up with your GitHub account (free).

### 3. Create a new project
- Click "New Project" → "Deploy from GitHub repo"
- Select your emergency project repository
- Railway will detect PHP automatically

### 4. Add a MySQL database
- In your Railway project, click "+ New" → "Database" → "MySQL"
- Railway creates the database and generates connection credentials automatically

### 5. Set environment variables
In your Railway project settings → Variables, add:
```
DB_HOST     = (copy from Railway MySQL connection info — looks like "containers-us-west-xxx.railway.app")
DB_USER     = (copy from Railway MySQL — usually "root")
DB_PASS     = (copy from Railway MySQL — auto-generated password)
DB_NAME     = db_ems
```

### 6. Import your database
- In Railway, click your MySQL service → "Connect" tab → copy the connection string
- Use TablePlus, DBeaver, or MySQL Workbench to connect
- Import the `database/db_ems.sql` file from your project

### 7. Get your live URL
Railway gives you a URL like `your-project.up.railway.app` automatically.
You can add a custom domain later if you want.

---

## Known Limitations (note these in your README)

- **File uploads don't persist** — Railway's filesystem resets on each deploy. 
  Uploaded photos and videos won't survive a redeploy.
  Production fix: use Cloudinary or AWS S3 for file storage.

- **Free tier limitations** — Railway's free tier has a $5/month usage credit.
  For a portfolio demo with low traffic this is more than enough.

---

## Testing Your Deployment

After deploying, test these flows:
1. Homepage loads at your Railway URL
2. Admin login works (use credentials from your database)
3. User can submit an emergency report
4. Agency portal loads and can view reports
```
