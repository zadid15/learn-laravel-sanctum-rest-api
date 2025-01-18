# 🚀 Learn Laravel Sanctum REST API

Using Laravel Version: 11.x

## 👋 Welcome
Welcome to the "Learn Laravel Sanctum REST API with Logging and Database Query Tracking" repository! This project is a hands-on learning journey into building REST APIs using Laravel Sanctum, with a focus on secure authentication, robust data management, efficient logging, and tracking database queries.

This repository also features a comprehensive CRUD (Create, Read, Update, Delete) functionality for a ToDoList application, allowing you to manage tasks efficiently while learning best practices in API development.

---

## 🎯 What I'm Learning
Here's an overview of the topics covered:

- **Introduction to Laravel Sanctum**: Setting up and understanding token-based authentication.
- **Configuring the Environment**: Proper `.env` file setup for seamless operation.
- **CRUD Operations for ToDoList**:
  - **Create**: Adding new tasks.
  - **Read**: Viewing tasks.
  - **Update**: Editing existing tasks.
  - **Delete**: Removing tasks.
- **Custom Logging**: Tracking user actions with details like IP addresses and timestamps.
- **User Authentication**: Securely managing user sessions via Laravel Sanctum.

---

## 📚 Key Features

1. **User Authentication**:
   - Token-based authentication for secure API access.
   - Protected API routes requiring user authentication.

2. **ToDoList Management**:
   - Comprehensive CRUD functionality.
   - Input validation and error handling.

3. **Activity Logging**:
   - Custom database logging of user actions.
   - Detailed records, including IP address, actions, and timestamps.

---

## 🔗 Endpoints Overview

| Method   | Endpoint                 | Description                  | Authentication Required  |
|----------|--------------------------|------------------------------|--------------------------|
| `POST`   | `/api/register`          | Register a new user          | No                       |
| `POST`   | `/api/login`             | Log in to get an API token   | No                       |
| `POST`   | `/api/logout`            | Log out and revoke token     | Yes                      |
| `GET`    | `/api/to-do-lists`       | Retrieve all ToDoList items  | Yes                      |
| `POST`   | `/api/to-do-lists`       | Create a new ToDoList item   | Yes                      |
| `PUT`    | `/api/to-do-lists/{id}`  | Update a ToDoList item       | Yes                      |
| `DELETE` | `/api/to-do-lists/{id}`  | Delete a ToDoList item       | Yes                      |

---

## 🙏 Acknowledgements

A huge thanks to the Laravel community and their extensive documentation for guiding this project. Special recognition to the YouTube channel **Muba Teknologi** for their invaluable tutorials and insights that helped shape this project.

---

Thank you for exploring this project! 🌟