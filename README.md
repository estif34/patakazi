# PataKazi (Job-Board App)

This Laravel-based job-board application allows users to explore job postings, post new opportunities, and manage job listings. It features a responsive UI and supports job categorization and search functionality for enhanced user experience.

## Features
- **Public Job Browsing**: View job posts without the need to log in.
- **Job Posting**: Registered users can create and post new job opportunities.
- **Edit Listings**: Users can edit their job posts.
- **Categorization**: Jobs are categorized for easier navigation.
- **Search Functionality**: Search jobs by title, location, category, or keywords.
- **User Dashboard**: View statistics on total, active, and deactivated job posts.
- **Responsive Design**: Fully functional on both desktop and mobile devices.

## Prerequisites
- PHP (>= 8.2)
- Composer
- Laravel (>= 9.0)
- A database (e.g., MySQL)
- Node.js 

## Installation
1. Clone the repository:
   ```bash
   git clone https://github.com/estif34/patakazi.git
   cd patakazi
   ```
2. Install dependencies:
   ```bash
   composer install
   npm install
   npm run dev
   ```
3. Set up the environment:
   ```bash
   copy .env.example .env
   ```
   - Configure the .env file with your database and application settings.
   
4. Generate the application key:
   ```bash
   php artisan key:generate
   ```
5. Run migrations to set up the database:
   ```bash
   php artisan migrate
   ```
6. Seed the database
   - Generate test user and data to check functionality
   ```bash
   php artisan db:seed
   ```
   - Test user credentials 
      - email: user@example.com
      - password: password
   - Loggin in using the above account allows to alter/edit the seeded data (test job posts)
   
7. Start the development server:
   ```bash
   php artisan serve
   ```
8. Access the application at http://127.0.0.1:8000

## External Libraries
 - Laravel Breeze: For authentication scaffolding.
 - TailwindCSS: For responsive UI components.
 - Laravel Debugbar: Optional, for debugging during development.
   


   
   
