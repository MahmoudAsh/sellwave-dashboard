# SellWave - Instagram E-commerce Platform

SellWave is a modern e-commerce platform designed specifically for Instagram sellers to manage their products and orders received through Instagram direct messages.

## Features

- 📦 **Product Management**: Add, edit, and manage your product catalog
- 📱 **Instagram Order Tracking**: Track orders from Instagram DMs with customer details
- 📊 **Dashboard Analytics**: View revenue, order statistics, and performance metrics
- 🔍 **Advanced Filtering**: Filter orders by status, product, and customer information
- 💎 **Modern UI**: Beautiful, responsive design built with Tailwind CSS
- 🚀 **Fast Performance**: Built on Laravel with optimized asset compilation

## Tech Stack

- **Backend**: Laravel 10.x (PHP 8.1+)
- **Frontend**: Tailwind CSS, Vite
- **Database**: PostgreSQL (Production) / SQLite (Development)
- **Deployment**: Render.com (Free hosting)

## Local Development Setup

1. **Clone the repository**
```bash
git clone <your-repo-url>
cd sellwave-dashboard
```

2. **Install dependencies**
```bash
composer install
npm install
```

3. **Environment setup**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Database setup**
```bash
touch database/database.sqlite
php artisan migrate --seed
```

5. **Build assets and start server**
```bash
npm run dev
php artisan serve
```

Visit `http://localhost:8000` to see the application.

## Deployment to Render.com (Free)

### Prerequisites
- GitHub account
- Render.com account (free)

### Step-by-Step Deployment

1. **Push your code to GitHub**
```bash
git init
git add .
git commit -m "Initial commit"
git branch -M main
git remote add origin <your-github-repo-url>
git push -u origin main
```

2. **Connect to Render.com**
- Go to [render.com](https://render.com) and sign up/login
- Click "New +" and select "Blueprint"
- Connect your GitHub repository
- Render will automatically detect the `render.yaml` file

3. **Configure Environment Variables**
Render will automatically set up the database and environment variables based on the `render.yaml` file.

4. **Deploy**
- Click "Apply" to start the deployment
- Wait for the build and deployment to complete (5-10 minutes)
- Your app will be available at `https://your-app-name.onrender.com`

### Manual Render Setup (Alternative)

If blueprint deployment doesn't work:

1. **Create Web Service**
- In Render dashboard, click "New +" → "Web Service"
- Connect your GitHub repo
- Set the following:
  - **Build Command**: `composer install --no-dev --optimize-autoloader && npm install && npm run build`
  - **Start Command**: `php artisan migrate --force && php artisan db:seed --force && php artisan serve --host=0.0.0.0 --port=$PORT`

2. **Create PostgreSQL Database**
- Click "New +" → "PostgreSQL"
- Choose the free plan
- Note the connection details

3. **Set Environment Variables**
Add these in your Web Service settings:
```
APP_NAME=SellWave
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:YourGeneratedKeyHere
DB_CONNECTION=pgsql
DB_HOST=[from your PostgreSQL service]
DB_PORT=5432
DB_DATABASE=[from your PostgreSQL service]
DB_USERNAME=[from your PostgreSQL service]
DB_PASSWORD=[from your PostgreSQL service]
```

## Sample Data

The application comes with sample products and orders to demonstrate functionality:

- **8 Sample Products**: Electronics, coffee, plants, etc. with product images
- **8 Sample Orders**: Realistic Instagram customer orders with messages
- **Dashboard Data**: Revenue calculations and statistics

## Key Features Explained

### Dashboard
- Total products, orders, and revenue metrics
- Recent orders overview
- Top-selling products
- Quick action buttons

### Product Management
- Product catalog with images and pricing
- Order tracking per product
- Revenue calculations

### Order Management
- Instagram customer details
- Message content from DMs
- Order status tracking (Pending, In Progress, Completed, Cancelled)
- Advanced filtering and search

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## License

This project is open source and available under the [MIT License](LICENSE).

## Support

For support, please create an issue in the GitHub repository or contact the development team.

---

Built with ❤️ for Instagram entrepreneurs 