# Student Learning Community Platform

<div align="center">
  
![Version](https://img.shields.io/badge/version-1.0.0-blue.svg)
![PHP](https://img.shields.io/badge/PHP-7.0+-purple.svg)
![License](https://img.shields.io/badge/license-MIT-green.svg)

</div>

A web application for students to connect, share posts, engage in discussions, and collaborate on learning modules.

<div align="center">
  
**[Features](#features) • [Technology Stack](#technology-stack) • [Installation](#installation) • [Usage](#usage) • [Admin Features](#admin-features)**

</div>

## ✨ Features

- 🔐 **User Authentication** - Secure signup, login, and profile management
- ✉️ **Email Verification** - Account verification and password reset functionality
- 📝 **Content Management** - Create, read, edit, and delete posts
- 💬 **Interactive Comments** - Comment system with voting capabilities
- 👤 **User Profiles** - Customizable user profiles
- 📚 **Learning Modules** - Structured learning content
- 🛠️ **Admin Dashboard** - Comprehensive admin controls
- 📱 **Responsive Design** - Works on desktop and mobile devices

## 🚀 Technology Stack

- **Backend**: PHP 7.0+
- **Frontend**: HTML5, CSS3, JavaScript
- **Database**: MySQL
- **Email**: PHPMailer
- **Server**: Apache/Nginx

## 📂 Project Structure

```
project/
├── controllers/    # Request processing logic
├── models/         # Data models and database interaction
├── views/          # HTML templates and frontend assets
├── utils/          # Utility functions and helpers
├── uploads/        # User-uploaded content
├── css/            # Custom stylesheets
└── vendor/         # Third-party dependencies
```

## 💻 Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/username/student-learning-platform.git
   cd student-learning-platform
   ```

2. **Configure web server**
   - Point Apache/Nginx to the project directory
   - Enable required PHP extensions

3. **Set up database**
   - Create a MySQL database
   - Import the schema file (located in `utils/schema.sql`)
   - Configure connection in `utils/config.php`

4. **Install dependencies**
   ```bash
   composer install
   ```

5. **Set permissions**
   ```bash
   chmod 755 -R uploads/
   ```

## 🔧 Usage

1. Navigate to the application URL in your browser
2. Create an account or log in with demo credentials:
   - Username: `demo@example.com`
   - Password: `demo123`
3. Explore the platform:
   - View the feed of recent posts
   - Add comments and votes
   - Create your own content
   - Join learning modules

## 👑 Admin Features

Admin users have additional capabilities through the admin dashboard:

- **User Management** - Create, edit, and deactivate user accounts
- **Content Moderation** - Review and moderate user-generated content
- **Analytics** - View platform usage statistics
- **Module Management** - Create and manage learning modules

## 📝 License

This project is licensed under the MIT License - see the LICENSE file for details. 
