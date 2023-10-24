# PHP-Todo-App

 ## Todo App -- Todo List

   * Folder and Routing Structure
   * Theme Integration
   * Database Connection
   * Database Tables
   * Login Process

  ## Todo Categories
   * Listing
   * Adding
   * Updating
   * Deleting

   ## Todo Tasks
   * Listing
   * Adding
   * Updating
   * Deleting

  ## Todo Statistics

  ## Tables
  ### Users
  > * id
  > * name
  > * surname
  > * mail
  > * password
  > * last_move
  > * created_date
  > * updated_date
  
  ### TodoCategories
  > * id
  > * user_id
  > * title
  > * created_date
  > * updated_date

  ### Todo
  > * id
  > * user_id
  > * category_id
  > * title
  > * description
  > * color
  > * end_date
  > * start_date
  > * created_date
  > * updated_date