# Objectives

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
5. [ ] - Making the Forms
   1. [x] - Creating the form for `Articles`
   2. [ ] - Creating the form for `Categories`
   3. [ ] - Creating the form for `Tags`
   4. [ ] - Creating the form for `Comments` inside `Articles`
   5. [ ] - Creating the form for `User` using the `Registration:Form` command in the CLI
6. [x] - Making the Database
7. [x] - Making the migrations
8. [x] - Migrate
9. [ ] - Making the Crud for the controllers
    1. [ ] - For `ArticlesController`
       1. [x] - An `index` method with all articles
       2. [x] - A `new` method to create a new article
       3. [x] - An `edit` method with the articles information for updating
       4. [ ] - A `show` method with one article details
       5. [ ] - A `delete` method to delete an article
       6. [ ] - Fuse Both `Edit` & `New` methods in one
       7. [ ] - Eventually add a Pagination with 10 articles max per page (using Doctrine and the query Builder)
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
              1.  [ ] - Change the style to make it appealing
          2.  [ ] - Display all written comments and their related articles
          3.  [ ] - Display an `Edit` & `Delete` button actions besides the `Articles`
10. [ ] - Logged In and Registered Users can make `New Articles`
11. [ ] For `New Article`
    1.  [x] - Make sure the user can select and look for mulitple `Tags`
    2.  [ ] - Make sure the user can add `New Tags` if he can't find the ones corresponding to his article
    3.  [ ] - Make sure the user can add `New Category` if he can't find the category for his article
    4.  [ ] - Delete the `User` select from the form, and add directly in the `ArticleController` the `User_ID` when saving the article
    5.  [x] - User can upload their image for the article, and we will save it to specified folder with each image having a `unique name`
12. [ ] - For `Filtering` Options in `Articles View Template`
    1.  [ ] - When clicking on a `category` , show only the articles of that category
    2.  [ ] - When clicking on a `tag`, show only the articles with that tag
    3.  [ ] - When clicking on a `user`, show only the articles of that user
13. [ ] - For the admin dashboard use a package `(easyAdmin)`
14. [ ] - For `Article View Template`
15. [ ] - For `HomeController` && `Home View Template`
      1. [ ] - An index with the newest articles to show in the Hero Section (4 max, caroussel with `DaisyUI` -> Vertical Carousel OR Carousel With next/prev buttons)
      2. [ ] - A section about the most liked/viewed articles (6 max)
16. [ ] - For `Login` & `Registration`, add redirection links to each other
17. [ ] - After adding email Confirmation, Add the `Forgot Password` feature
18. [ ] - Handle `Page Errors` Templates
    1.  [x] - 404
    2.  [ ] - 403
    3.  [ ] - 500


## Future Fixes
1. [ ] - Fix The Delete Modal for `Article`.
