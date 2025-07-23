# PKKB - Laravel Application

This is a Laravel application configured for deployment on Vercel.

## Local Development

1. Clone the repository
2. Install dependencies:
   ```bash
   composer install
   npm install
   ```
3. Copy environment file:
   ```bash
   cp .env.example .env
   ```
4. Generate application key:
   ```bash
   php artisan key:generate
   ```
5. Run database migrations:
   ```bash
   php artisan migrate
   ```
6. Start the development server:
   ```bash
   php artisan serve
   ```

## Deployment on Vercel

This application is configured to deploy on Vercel with the following setup:

### Required Environment Variables

Set these in your Vercel dashboard:

```
APP_NAME=PKKB
APP_ENV=production
APP_KEY=base64:your-app-key-here
APP_DEBUG=false
APP_URL=https://your-app-name.vercel.app

DB_CONNECTION=mysql
DB_HOST=your-database-host
DB_PORT=3306
DB_DATABASE=your-database-name
DB_USERNAME=your-database-username
DB_PASSWORD=your-database-password
```

### Steps to Deploy:

1. Push your code to GitHub
2. Connect your GitHub repository to Vercel
3. Set the environment variables in Vercel dashboard
4. Deploy!

### Important Notes:

- The application uses `/tmp` directory for caching in production
- Sessions use cookie driver for stateless deployment
- Logs are directed to stderr for Vercel compatibility
- Static assets are served directly by Vercel

## Database Setup

For production, you'll need to set up a database (like PlanetScale, Railway, or any MySQL-compatible service) and update the environment variables accordingly.

## File Storage

For file uploads in production, consider using:
- AWS S3
- Cloudinary
- Vercel Blob Storage

Update the `FILESYSTEM_DISK` environment variable accordingly.
