# Kostel Reservation & Operations Platform

A web-based application for managing "Kostel" (Boarding House/Hotel) reservations, rooms, and daily operations. Built with Laravel 9, this system streamlines the process of checking in guests, managing room availability, and generating financial and operational reports.

## Features

-   **Authentication & Roles**
    -   Secure Login/Logout systems.
    -   Role-based access control (Admin, Employee).
    -   Password management.

-   **Room Management**
    -   Manage Room Types and Prices.
    -   Manage Individual Rooms and their statuses.
    -   Upload and manage Room Images.

-   **Reservation & Front Desk**
    -   **Reservations**: Create, search, and manage guest reservations.
    -   **Check-In/Check-Out**: Streamlined process for guest arrival and departure.
    -   **Reservation Types**: Support for different booking types (e.g., Short stay, Overnight).
    -   **Receipts**: Generate print-ready receipts for check-ins.

-   **Reporting & Analytics**
    -   **Dashboard**: Overview of current status.
    -   **Visual Charts**:
        -   Check-In Trends.
        -   Reservation Statistics.
    -   **Detailed Reports**:
        -   Employee Performance.
        -   Reservation History.
        -   Check-In/Check-Out Logs.
        -   Available Rooms.
        -   Financial/Revenue Reports.
    -   **Printing**: All reports and charts are optimized for printing.

## Tech Stack

-   **Backend**: [Laravel 9.x](https://laravel.com)
-   **Language**: PHP 8.1+
-   **Frontend**: Blade Templates, [Vite](https://vitejs.dev)
-   **Database**: MySQL
-   **Charts**: [ConsoleTVs/Charts](https://github.com/ConsoleTVs/Charts) (Chart.js wrapper)

## Installation

Follow these steps to set up the project locally:

1.  **Clone the repository**
    ```bash
    git clone https://github.com/yourusername/reservasi-dan-manajemen-kostel.git
    cd reservasi-dan-manajemen-kostel
    ```

2.  **Install Dependencies**
    ```bash
    composer install
    npm install
    ```

3.  **Environment Configuration**
    Copy the `.env.example` file to `.env` and configure your database settings:
    ```bash
    cp .env.example .env
    ```
    Update the `DB_` variables in `.env` to match your local database credentials.

4.  **Generate Application Key**
    ```bash
    php artisan key:generate
    ```

5.  **Run Migrations and Seeders**
    This will create the database tables and insert default data (including the admin account).
    ```bash
    php artisan migrate --seed
    ```

6.  **Build Frontend Assets**
    ```bash
    npm run build
    ```
    Or for development:
    ```bash
    npm run dev
    ```

7.  **Run the Application**
    ```bash
    php artisan serve
    ```
    Visit `http://localhost:8000` in your browser.

## Usage

### Default Login
After seeding the database (`php artisan migrate --seed`), you can log in with the following default credentials:

-   **Username**: `admin`
-   **Password**: `admin`

### Key Workflows
1.  **Dashboard**: Upon login, view the main dashboard for a quick overview.
2.  **Setup**: Go to Room Management to define Room Types and Rooms if not already seeded.
3.  **Operations**: Use the "Check-In" or "Reservation" menus to handle guests.
4.  **Reports**: Access the Reports section to view and print operational and financial data.

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
