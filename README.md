# 📚 NeoBlog

A simple blog web application built with the Symfony PHP framework, designed as a school project to practice web development fundamentals and more advanced features like authentication and authorization.

---

## 🚀 Features

- User-friendly interface to read blog posts.
- Admin dashboard to create, edit, and delete posts.
- Categories and tags for articles.
- Comment system.
- Responsive design using Tailwind CSS and DaisyUI.
- AlpineJS for dynamic UI updates.

---

## 🛠️ Tech Stack

- **Backend:** PHP 8.2, Symfony 7
- **Frontend:** Twig, Tailwind, DaisyUI, AlpineJS, AOS (Animation on Scroll)
- **Database:** MySQL
- **Tools:** Composer, Symfony CLI

---

## 📥 Installation

### Prerequisites

- PHP 8.2+
- Composer
- Symfony CLI
- MySQL

### Steps

1. Clone the repository:
   ```bash
   git clone https://github.com/Hex-Umbra/Blog_Symfony.git

2. Install dependencies:    
    ```bash
    composer install
3. Set up environment variables in `.env` file:
   ```bash 
    cp .env .env.local
4. Set up database credentials in `.env.local` file
5. Create database:
   ```bash
   php bin/console doctrine:database:create
6. Run migrations:
    ```bash
    php bin/console doctrine:migrations:migrate
7. Start Server:
    ```bash
    symfony server:start

Access the project at http://127.0.0.1:8000

---
## 📸 Screenshots
## 📸 Screenshots

### 🏠 Homepage

<img src="screenshots/homepage_1.png" alt="Homepage Screenshot" width="1000"/>
<img src="screenshots/homepage_2.png" alt="Homepage Screenshot 2" width="1000"/>

---

### 📄 Article Index Page

![Articles Index Screenshot](screenshots/articles_index.png)

---

### 📃 Article Show Page

![Article Show Screenshot](screenshots/article_show.png)

---

### 👤 User Profile

![User Profile Screenshot](screenshots/user_profile.png)

---

### 🛠️ Admin Panel

![Admin Panel Screenshot](screenshots/admin_panel.png)












<!-- # Objectives

1. [ ] - Make the Wireframe of the application in `Figma`
2. [x] - Making the controllers
    1. [x] - Creating the `HomeController`
    2. [x] - Creating the `ArticlesController`
    3. [ ] - Creating the `CommentsController`
    4. [ ] - Creating the `CategoriesController`
    5. [ ] - Creating the `TagsController`
    6. [ ] - Creating the `AboutController`
3. [x] - Making the models
    1. [x] - Creating the `User` model
    2. [x] - Creating the `Articles` model
    3. [x] - Creating the `Comments` model
    4. [x] - Creating the `Categories` model
    5. [x] - Creating the `Tags` model
4. [x] - Making the Relations between models
    1. [x] - Creating the relations between `User` and `Articles`
    2. [x] - Creating the relations between `Articles` and `Comments`
    3. [x] - Creating the relations between `Articles` and `Categories`
    4. [x] - Creating the relations between `Articles` and `Tags`
    5. [x] - Creating the relations between `Comments` and `User`
5. [x] - Making the Database
6. [x] - Making the migrations
7. [x] - Migrate
8. [ ] - Making the Crud for the controllers
    1. [ ] - For `ArticlesController`
       1. [x] - An `index` method with all articles
       2. [x] - A `new` method to create a new article
       3. [x] - An `edit` method with the articles information for updating
       4. [x] - A `show` method with one article details
       5. [x] - A `delete` method to delete an article
       6. [x] - Fuse Both `Edit` & `New` methods in one
       7. [x] - Eventually add a Pagination with 10 articles max per page
       8. [ ] - 
    2. [ ] - For `User`
      1.  [x] - For `User Registration` use a mailer system to confirm the email
      2.  [x] - For `User Login` with the mailer system make a a forgot password system
      3.  [ ] - Add Flash Message for `Registration`
      4.  [ ] - Add Flash Message for `Email Validation`
      5.  [ ] - Add Flash Message for `Email Password Reset`
      6.  [ ] - Add Flash Message for `Successful Password Reset`
      7.  [ ] - Add Flash Message for `Login`
      8.  [ ] - Add Flash Message for `Logout`
      9.  [ ] - Make a `User Profile`
          1.  [x] - Display all written articles
          2.  [ ] - Change the style to make it appealing
          3.  [ ] - Display all written comments and their related articles
          4.  [ ] - Display an `Edit` & `Delete` button actions besides the `Articles`
9.  [x] - Logged In and Registered Users can make `New Articles`
10. [ ] For `New Article`
    1.  [x] - Make sure the user can select and look for mulitple `Tags`
    2.  [x] - Delete the `User` select from the form, and add directly in the `ArticleController` the `User_ID` when saving the article
    3.  [x] - User can upload their image for the article, and we will save it to specified folder with each image having a `unique name`
11. [ ] - For `Filtering` Options in `Articles View Template`
    1.  [x] - When clicking on a `category` , show only the articles of that category
    2.  [x] - Choose one or mutliple `Tags` and show only the articles with chosen tags
    3.  [ ] - When clicking on a `user`, show only the articles of that user
12. [x] - For the admin dashboard use a package `(easyAdmin)`
13. [ ] - For `HomeController` && `Home View Template`
      1. [x] - a section with the featured article to show 
      2. [x] - A section about the most recent articles (4 max)
14. [ ] - For `Login` & `Registration`, add redirection links to each other
15. [x] - After adding email Confirmation, Add the `Forgot Password` feature
16. [ ] - Handle `Page Errors` Templates
    1.  [x] - 404
    2.  [x] - 403
    3.  [x] - 500


## Future Fixes
1. [ ] - Fix The Delete Modal for `Article` in `User Profile` when a user is connected. -->
