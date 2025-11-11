# Freelance Hours

A modern Laravel-based platform for connecting clients with freelancers. Clients can post projects and freelancers can submit proposals with estimated hours.

## 🚀 Features

### Core Functionality
- **Project Management**: Create, edit, and manage freelance projects
- **Proposal System**: Freelancers can submit proposals with estimated hours
- **Authentication**: Complete user registration and login system
- **Dashboard**: Comprehensive dashboard with statistics and activity overview
- **Search & Filters**: Advanced search and filtering by status, technology, and keywords
- **Categories**: Organize projects by categories (Web Development, Mobile Apps, E-commerce, etc.)
- **Favorites**: Save projects as favorites for quick access
- **Notifications**: Real-time notifications for new proposals
- **Admin Panel**: Admin users can edit all projects

### Technical Features
- **SOLID Principles**: Clean architecture with Repository and Service layers
- **DTOs**: Data Transfer Objects for structured data handling
- **Form Requests**: Centralized validation logic
- **Custom Exceptions**: Specific exceptions for business logic errors
- **Eloquent Relationships**: Well-defined model relationships
- **Responsive Design**: Modern UI with Tailwind CSS (black, white, gray theme)

## 📋 Requirements

- PHP >= 8.2
- Composer
- Node.js & NPM
- SQLite (or MySQL/PostgreSQL)

## 🛠️ Installation

1. **Clone the repository**
   ```bash
   git clone git@github.com:devmxs-code/freelance-hours.git
   cd freelance-hours
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Database setup**
   ```bash
   php artisan migrate --seed
   ```

6. **Build assets**
   ```bash
   npm run build
   ```

7. **Start the development server**
   ```bash
   php artisan serve
   ```

   The application will be available at `http://localhost:8000`

## 👤 Default Admin Account

- **Email**: `user@admin.com`
- **Password**: `admin`

## 📁 Project Structure

```
app/
├── DTOs/                    # Data Transfer Objects
├── Enums/                   # Enumerations (ProjectStatus)
├── Exceptions/              # Custom exceptions
├── Http/
│   ├── Controllers/         # Controllers
│   │   ├── Auth/           # Authentication controllers
│   │   └── ...             # Feature controllers
│   └── Requests/           # Form Requests (validation)
├── Models/                  # Eloquent Models
├── Repositories/            # Repository pattern implementation
│   └── Contracts/          # Repository interfaces
└── Services/                # Service layer
    └── Contracts/           # Service interfaces

database/
├── factories/               # Model factories
├── migrations/              # Database migrations
└── seeders/                 # Database seeders
```

## 🎯 Usage

### For Clients (Project Creators)

1. Register or login to your account
2. Access the dashboard
3. Click "New Project" to create a project
4. Fill in project details:
   - Title and description
   - Deadline
   - Technology stack
   - Categories
   - Status (Open/Closed)
5. View proposals received for your projects
6. Edit your projects as needed

### For Freelancers

1. Browse projects on the homepage (no login required)
2. Use search and filters to find relevant projects
3. Click on a project to view details
4. Submit a proposal with:
   - Your email
   - Estimated hours
5. (Optional) Login to track your proposals in the dashboard

## 🔧 Architecture

This application follows **SOLID principles** and **Clean Code** practices:

- **Single Responsibility**: Each class has one responsibility
- **Open/Closed**: Extensible through interfaces
- **Liskov Substitution**: Interfaces can be swapped
- **Interface Segregation**: Focused, specific interfaces
- **Dependency Inversion**: Dependencies through abstractions

### Design Patterns

- **Repository Pattern**: Abstracts data access
- **Service Layer**: Encapsulates business logic
- **DTO Pattern**: Structured data transfer
- **Factory Pattern**: Model factories for testing

## 🧪 Testing

```bash
php artisan test
```

## 📝 Database Seeders

The application includes seeders with realistic data:

- **AdminUserSeeder**: Creates admin user
- **CategorySeeder**: Creates 8 project categories
- **RealProjectsSeeder**: Creates 8 users with 14 real projects

Run seeders:
```bash
php artisan db:seed
```

## 🎨 Styling

The application uses **Tailwind CSS** with a professional black, white, and gray color scheme.

Build assets:
```bash
npm run dev      # Development with hot reload
npm run build    # Production build
```

## 🔐 Security Features

- Password hashing
- CSRF protection
- SQL injection prevention (Eloquent ORM)
- XSS protection (Blade templating)
- Authorization checks (admin permissions)
- Form validation

## 📊 Database Schema

### Main Tables
- `users` - User accounts
- `projects` - Freelance projects
- `proposals` - Freelancer proposals
- `categories` - Project categories
- `project_categories` - Project-category relationships
- `favorites` - User favorite projects
- `notifications` - User notifications

### Future Features (Migrations Ready)
- `ratings` - Project and user ratings
- `comments` - Proposal comments
- `activity_logs` - Activity tracking

## 🚦 Routes

### Public Routes
- `GET /` - List all projects
- `GET /projects/{id}` - Show project details
- `POST /projects/{id}/proposals` - Submit proposal

### Authentication Routes
- `GET /login` - Login form
- `POST /login` - Login
- `GET /register` - Registration form
- `POST /register` - Register
- `POST /logout` - Logout

### Authenticated Routes
- `GET /dashboard` - User dashboard
- `GET /projects/create` - Create project form
- `POST /projects` - Store project
- `GET /projects/{id}/edit` - Edit project form
- `PUT /projects/{id}` - Update project
- `POST /projects/{project}/favorite` - Add favorite
- `DELETE /projects/{project}/favorite` - Remove favorite
- `GET /notifications` - List notifications
- `POST /notifications/{id}/read` - Mark notification as read
- `POST /notifications/read-all` - Mark all as read

## 🤝 Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'feat: add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

### Commit Convention

This project follows [Conventional Commits](https://www.conventionalcommits.org/):

- `feat:` - New feature
- `fix:` - Bug fix
- `refactor:` - Code refactoring
- `style:` - UI/styling changes
- `docs:` - Documentation
- `chore:` - Maintenance tasks

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 👨‍💻 Author

**Marcelo Xavier**

- GitHub: [@devmxs-code](https://github.com/devmxs-code)

## 🙏 Acknowledgments

- Laravel Framework
- Tailwind CSS
- All contributors and open-source libraries used

---

Made with ❤️ using Laravel
