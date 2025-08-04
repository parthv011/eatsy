# Eatsy - Food Delivery System

A comprehensive web-based food delivery application built with PHP, MySQL, and Bootstrap. This system provides a complete solution for restaurants to manage their menu, process orders, and deliver food to customers.

## 🍽️ Features

### Customer Features
- **User Registration & Authentication** - Secure login/logout system
- **Menu Browsing** - View categorized food items with images and descriptions
- **Shopping Cart** - Add items to cart, update quantities, apply coupons
- **Order Placement** - Place orders with multiple payment options
- **Order Tracking** - Real-time order status updates
- **Order History** - View past orders and reorder functionality
- **Responsive Design** - Mobile-friendly interface

### Admin Features
- **Admin Dashboard** - Overview of users, orders, and menu items
- **Category Management** - Add, edit, and delete food categories
- **Menu Management** - Complete CRUD operations for menu items
- **Order Management** - View and update order statuses
- **Real-time Notifications** - Get notified of new orders

### Advanced Features
- **Session-based Cart** - Cart persistence across sessions
- **Database Cart Sync** - Sync cart data for logged-in users
- **Coupon System** - Multiple discount types (fixed amount & percentage)
- **Cart Validation** - Price and availability checks
- **Image Upload** - File upload for menu items and categories
- **Order Timeline** - Visual order tracking interface

## 🛠️ Technologies Used

- **Backend**: PHP 7.4+
- **Database**: MySQL
- **Frontend**: HTML5, CSS3, JavaScript
- **Framework**: Bootstrap 5.3
- **Icons**: Font Awesome, Bootstrap Icons
- **Fonts**: Google Fonts (Poppins)

## 📁 Project Structure

```
eatsy/
├── admin/
│   ├── admin_dashboard.php
│   ├── admin_login.php
│   ├── manage_categories.php
│   ├── manage_menu.php
│   ├── manage_orders.php
│   └── uploads/
├── auth/
│   ├── admin_login.php
│   ├── login.php
│   ├── logout.php
│   └── register.php
├── backend/
│   └── add_to_cart.php
├── includes/
│   ├── db.php
│   ├── header.php
│   ├── footer.php
│   ├── sidebar.php
│   ├── schema.sql
│   └── uploads/
├── users/
│   ├── cart.php
│   ├── menu.php
│   ├── my_order.php
│   ├── order_confirmation.php
│   ├── order_tracing.php
│   ├── header.php
│   └── footer.php
└── home.php
```

## 🚀 Installation

### Prerequisites
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Apache/Nginx web server
- Web browser

### Setup Instructions

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd eatsy
   ```

2. **Database Setup**
   - Create a new MySQL database named `project_db`
   - Import the database schema:
   ```sql
   mysql -u root -p project_db < includes/schema.sql
   ```

3. **Configure Database Connection**
   - Edit `includes/db.php`
   - Update database credentials:
   ```php
   $host = 'localhost';
   $user = 'your_username';
   $password = 'your_password';
   $database = 'project_db';
   ```

4. **Set Directory Permissions**
   ```bash
   chmod 755 admin/uploads/
   chmod 755 includes/uploads/
   ```

5. **Start Web Server**
   - Place the project in your web server document root
   - Access the application at `http://localhost/eatsy/`

## 🗄️ Database Schema

### Core Tables
- **users** - Customer information and authentication
- **admins** - Admin user credentials
- **categories** - Food categories (Pizza, Burgers, etc.)
- **menu_items** - Individual food items with prices and images
- **cart** - Shopping cart items for logged-in users
- **orders** - Order information and status
- **order_items** - Individual items within each order
- **contact_messages** - Customer inquiries

### Sample Data
The system includes sample data:
- Default admin user: `admin` / `admin123`
- Sample pizza category with menu items

## 👥 User Roles

### Customer Access
- Registration and login required for checkout
- Browse menu without authentication
- Cart functionality available for all users
- Order placement requires login

### Admin Access
- **Username**: `admin`
- **Password**: `admin123`
- Full system management capabilities
- Order processing and status updates

## 🛒 Cart System Features

### Session-based Cart
- Works for both logged-in and guest users
- Persistent across browser sessions
- Automatic price validation

### Advanced Cart Operations
- Add/update/remove items
- Quantity management
- Coupon code application
- Database synchronization for logged-in users

### Available Coupons
- **EAT50**: ₹50 off on orders ≥₹299
- **EAT75**: ₹75 off on orders ≥₹399
- **EAT100**: ₹100 off on orders ≥₹599
- **WELCOME10**: 10% off on orders ≥₹200

## 📊 Order Management

### Order Statuses
- **Pending** - New orders awaiting confirmation
- **Processing** - Order being prepared
- **Completed** - Order delivered successfully
- **Cancelled** - Order cancelled by customer/admin

### Order Features
- Real-time status updates
- Order timeline visualization
- Reorder functionality
- Order cancellation (pending orders only)
- Detailed order history

## 🎨 UI/UX Features

### Design Elements
- Modern, responsive design
- Gradient backgrounds and animations
- Card-based layout
- Interactive buttons and hover effects
- Mobile-first approach

### User Experience
- Intuitive navigation
- Real-time cart updates
- Loading states and animations
- Success/error notifications
- Breadcrumb navigation

## 🔧 Configuration

### File Upload Settings
- Maximum file size: 2MB
- Allowed formats: JPG, PNG, GIF
- Automatic filename generation
- Image validation and security

### Security Features
- Password hashing (PHP's password_hash)
- SQL injection prevention (prepared statements)
- Input validation and sanitization
- Session-based authentication
- CSRF protection considerations

## 📱 API Endpoints

### Cart API (`backend/add_to_cart.php`)
- `POST` - Add items to cart
- `POST` - Update item quantities
- `POST` - Remove items from cart
- `POST` - Apply coupon codes
- `POST` - Sync cart to database
- `POST` - Validate cart items

## 🚧 Development Notes

### Known Limitations
- No payment gateway integration
- Email notifications not implemented
- Limited user profile management
- No delivery tracking GPS

### Future Enhancements
- Payment gateway integration (Razorpay, PayPal)
- SMS/Email notifications
- Real-time order tracking
- Customer reviews and ratings
- Multi-restaurant support
- Delivery partner management

## 🐛 Troubleshooting

### Common Issues

1. **Database Connection Failed**
   - Check database credentials in `includes/db.php`
   - Ensure MySQL service is running

2. **Image Upload Not Working**
   - Check directory permissions for `uploads/` folders
   - Verify PHP file upload settings

3. **Cart Not Working**
   - Check browser localStorage support
   - Verify session configuration

4. **Admin Login Issues**
   - Default credentials: admin/admin123
   - Check admin table in database

## 📄 License

This project is open source and available under the [MIT License](LICENSE).

## 🤝 Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📞 Support

For support and queries:
- Create an issue in the repository
- Contact the development team
- Check the documentation

## 🏆 Acknowledgments

- Bootstrap team for the excellent CSS framework
- Font Awesome for the icons
- Google Fonts for typography
- PHP community for extensive documentation

---

**Note**: This is a educational/demonstration project. For production use, implement additional security measures, payment gateways, and proper error handling.