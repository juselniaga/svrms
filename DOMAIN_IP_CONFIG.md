# SVRMS - Domain and IP Configuration Guide

## Current Status ✓
The application has been updated to support access via both domain name and IP address.

## Configuration Steps

### 1. **Update .env File** ✓
The following changes have been made:

```env
APP_NAME=SVRMS
APP_URL=http://localhost:8000
SESSION_PATH=/
SESSION_DOMAIN=null
```

### 2. **Configure for Your Domain/IP**

Choose one of the following approaches based on your setup:

#### **Option A: Using IP Address**
If accessing via IP (e.g., `http://192.168.1.100:8000`):

```env
APP_URL=http://192.168.1.100:8000
SESSION_DOMAIN=null
SESSION_SECURE_COOKIE=false
```

#### **Option B: Using Domain Name**
If using a domain (e.g., `http://yourdomain.com`):

```env
APP_URL=http://yourdomain.com
SESSION_DOMAIN=yourdomain.com
SESSION_SECURE_COOKIE=false
```

#### **Option C: Using Subdomain**
If using subdomains (e.g., `http://app.yourdomain.com` and `http://admin.yourdomain.com`):

```env
APP_URL=http://app.yourdomain.com
SESSION_DOMAIN=.yourdomain.com
SESSION_SECURE_COOKIE=false
```

#### **Option D: Using HTTPS**
If using HTTPS (production recommended):

```env
APP_URL=https://yourdomain.com
SESSION_DOMAIN=yourdomain.com
SESSION_SECURE_COOKIE=true
SESSION_SAME_SITE=lax
```

### 3. **Host File Configuration (Windows)**

To test with a local domain, edit `C:\Windows\System32\drivers\etc\hosts`:

```
127.0.0.1       yourdomain.local
127.0.0.1       app.yourdomain.local
192.168.1.100   yourdomain.local
```

### 4. **Web Server Configuration**

#### **Using PHP Built-in Server**
```bash
php artisan serve --host=0.0.0.0 --port=8000
```

#### **Using Apache (httpd.conf or vhost)**
```apache
<VirtualHost *:80>
    ServerName yourdomain.com
    ServerAlias *.yourdomain.com
    DocumentRoot "D:\2026\SVRMS\svrms\public"
    
    <Directory "D:\2026\SVRMS\svrms\public">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

#### **Using Nginx**
```nginx
server {
    listen 80;
    server_name yourdomain.com *.yourdomain.com;
    root D:\2026\SVRMS\svrms\public;
    
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    
    location ~ \.php$ {
        fastcgi_pass 127.0.0.1:9000;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
```

### 5. **Firewall & Network**

Ensure your firewall allows traffic on the port:
- **Port 80** for HTTP
- **Port 443** for HTTPS
- **Port 8000** for development server

### 6. **Testing Access**

After configuration, test with:

```bash
# Local access
http://localhost:8000

# Domain access
http://yourdomain.com

# IP access
http://192.168.1.100:8000

# Subdomain access (if configured)
http://app.yourdomain.com
http://admin.yourdomain.com
```

### 7. **Troubleshooting**

**Issue: Session not persisting across domain/IP**
- Solution: Set `SESSION_DOMAIN` in `.env`

**Issue: CSRF token mismatch**
- Solution: Check `APP_URL` matches the actual URL you're accessing
- Solution: Ensure session domain is correctly set

**Issue: Cookies not being sent**
- Solution: For HTTPS, set `SESSION_SECURE_COOKIE=true`
- Solution: Check `SESSION_DOMAIN` and `SESSION_PATH` settings

**Issue: Access forbidden from IP/domain**
- Solution: Check your web server configuration (Apache/Nginx)
- Solution: Verify firewall rules

## Environment Variables Reference

| Variable | Purpose | Example |
|----------|---------|---------|
| `APP_URL` | Application base URL | `http://yourdomain.com` |
| `SESSION_DOMAIN` | Cookie domain scope | `yourdomain.com` or `.yourdomain.com` |
| `SESSION_PATH` | Cookie path scope | `/` |
| `SESSION_SECURE_COOKIE` | HTTPS only | `true` (production) |
| `SESSION_SAME_SITE` | CSRF protection | `lax` or `strict` |

## Security Notes

1. **Always use HTTPS in production**
2. **Use strong SESSION_DOMAIN settings** - avoid null for domain access
3. **Keep APP_DEBUG=false in production**
4. **Regularly update dependencies**

## Next Steps

1. Update your `.env` file with appropriate values for your domain/IP
2. Clear Laravel cache: `php artisan config:cache`
3. Clear session cache if needed: `php artisan session:table && php artisan migrate`
4. Test access from both domain and IP
5. Monitor logs for any access issues

---

**Configuration Updated:** 2026-05-19
**Last Modified:** .env file
