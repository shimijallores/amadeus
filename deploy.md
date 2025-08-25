# Deployment Guide for Merica Rocks

## Hosting Requirements
- **Recommended**: Hostinger Premium or Business plan
- **Why**: SSH access, composer/npm support, document root control
- **Alternative**: Any VPS or shared hosting with SSH

## Pre-Deployment Checklist

### 1. Environment Configuration
```bash
# Create production .env
cp .env.example .env.production
```

### 2. Build Production Assets
```bash
npm run build  # Build production CSS
```

### 3. Optimize Composer
```bash
composer install --no-dev --optimize-autoloader
```

## Hostinger Deployment Steps

### 1. Upload Files
Upload entire project to: `/domains/yourdomain.com/public_html/`

### 2. Change Document Root
In Hostinger control panel:
- Go to "Advanced" → "Subdomains/Add-on Domains" 
- Change document root from `public_html` to `public_html/public`
- This hides sensitive files (.env, vendor/, Core/, etc.)

### 3. SSH Setup (Premium/Business plans)
```bash
# Connect via SSH
ssh u123456789@yourdomain.com

# Navigate to project
cd domains/yourdomain.com/public_html

# Install dependencies
composer install --no-dev --optimize-autoloader
npm install
npm run build

# Set permissions
chmod -R 755 public/
chmod -R 755 uploads/
```

### 4. Database Setup
- Create database in Hostinger control panel
- Import your `database/database.sql`
- Update `.env` with production database credentials

### 5. Email Configuration
```env
# Production .env
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-business-email@domain.com
MAIL_PASSWORD=your-app-password
MAIL_FROM_ADDRESS=noreply@yourdomain.com
```

## Production Optimizations

### Security
- `.env` file is above document root ✓
- Sensitive directories not web-accessible ✓
- Database credentials protected ✓

### Performance
- Composer autoloader optimized
- CSS minified via Tailwind build
- File uploads isolated in `/uploads`

## Alternative Hosting Options

### VPS Options (More control)
- **DigitalOcean**: $6/month, full SSH access
- **Vultr**: $6/month, good performance
- **Linode**: $5/month, reliable

### Shared Hosting with SSH
- **A2 Hosting**: SSH access on shared plans
- **SiteGround**: SSH on higher tier plans

## Cost Comparison
- **Hostinger Premium**: ~$3/month, SSH access, perfect for your needs
- **Hostinger Business**: ~$4/month, better performance
- **VPS**: $5-10/month, full control but requires server management

## Recommendation
**Go with Hostinger Premium** - it's the sweet spot for your project:
- Cheap but reliable
- SSH access for npm/composer
- Document root control
- PHPMailer works perfectly
- Easy database management
