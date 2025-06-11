<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

## 🚀 Introduction
This project is a custom business rule-based process management system built with Laravel. It leverages modern development tools and practices to deliver a scalable and testable solution.

## 🧩 Features
- ⚙️ **Laravel**: Clean and elegant PHP framework for modern web applications.
- 🐋 **Docker**: Containerized environment for easy development and deployment.
- 🐚 **Shell Scripts**: Automated tasks to streamline setup and development workflow.
- 🧠 **Eloquent ORM**: Intuitive and expressive ActiveRecord implementation for database management.
- 🧪 **PHPUnit**: Robust unit testing support for ensuring application stability.
- 🐘 **PostgreSQL**: Reliable and powerful open-source relational database system.

## Getting Started

To get started with the project, make sure you have Docker and Docker Compose installed.

```bash
# Clone the repository
git clone https://github.com/LucasGRPiovesan/gestor_proceduring_laravel.git
cd gestor_proceduring_laravel

# Copy to .env and provide credentials 
cp .env.example .env

# Copy to docker-compose.override.yml for development
cp docker-compose.override.example.yml docker-compose.override.yml

# Start containers
docker-compose up --build
