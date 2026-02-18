# 🚀 Premium PHP POS System

A world-class, industry-leading Point of Sale (POS) system built with vanilla PHP and a premium, high-performance UI/UX. This project features a modern, touch-optimized terminal, a Bento Grid performance dashboard, and a sophisticated design system inspired by industry leaders like Square and Stripe.

![Premium POS Dashboard](https://github.com/user-attachments/assets/placeholder-dashboard)

## ✨ Key Features

### 💎 World-Class UI/UX
- **Bento Grid Dashboard**: Modular, card-based overview of store performance.
- **Split-Screen POS Terminal**: High-speed, touch-optimized terminal layout (60% products / 40% cart).
- **Glassmorphism Design**: Sophisticated backdrop blur effects and visual depth.
- **Premium Micro-Interactions**: Hover shine effects, spring-easing animations, and button glows.
- **Phosphor Iconography**: Unified, modern icon set for a professional feel.

### 📦 Inventory & Products
- **Hierarchical Categories**: Support for parent/sub-category management with visual indentation.
- **Smart Product Management**: Card-based grid with real-time "as-you-type" filtering.
- **Stock Tracking**: Low stock alerts and dedicated restocking functionality.
- **Barcode Support**: Ready for barcode scanning in the search interface.

### 💰 Sales & Transactions
- **Dynamic Cart**: AJAX-powered cart management with live totals, tax, and discount calculation.
- **Multi-Payment Methods**: Support for Cash, Card, and Cheque with visual selection.
- **Cash Management**: Automatic change calculation with real-time feedback.
- **Thermal Receipt Printing**: Custom-styled receipt view ready for printing.

### 👤 User Management
- **Role-Based Access**: Permission levels for Admins and Cashiers.
- **Profile Management**: Secure password reset and profile editing tools.
- **Premium Login**: Sophisticated glassmorphic auth interface.

## 🛠️ Technology Stack
- **Core**: PHP (MVC Architecture)
- **Database**: MySQL (PDO for secure queries)
- **Frontend**: HTML5, Vanilla CSS3 (Custom Design System), JavaScript (jQuery for AJAX)
- **UI Components**: Bootstrap 5, Glassmorphism CSS, Phosphor Icons
- **Typography**: Inter / SF Pro Display

## 🚀 Getting Started

### Prerequisites
- XAMPP / WAMP / MAMP or any local PHP server environment.
- MySQL Database.

### Installation
1. **Clone the repository**:
   ```bash
   git clone https://github.com/yourusername/pos-system.git
   ```
2. **Setup Database**:
   - Open phpMyAdmin.
   - Create a database named `pos_system`.
   - Import the `schema.sql` (if provided) or create the tables in `app/config/config.php` credentials.
3. **Configure the App**:
   - Edit `app/config/config.php`.
   - Set your `URLROOT` (e.g., `http://localhost/pos`).
   - Set your database credentials (`DB_HOST`, `DB_USER`, `DB_PASS`, `DB_NAME`).
4. **Run the App**:
   - Move the folder to your `htdocs` directory.
   - Navigate to `http://localhost/pos` in your browser.

### Default Credentials
- **Admin**: `admin` / `123456`
- **Cashier**: `cashier` / `123456`

## 📸 Screenshots

| Dashboard | POS Terminal |
|-----------|--------------|
| ![Dashboard] | ![POS Terminal] |

## 🤝 Contributing
Contributions are welcome! Please feel free to submit a Pull Request.

## 📄 License
This project is open-source and available under the [MIT License](LICENSE).

---
Developed with ❤️ for a premium merchant experience.
