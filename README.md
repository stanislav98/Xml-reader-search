# About the Project 
  This project allow you to insert / update / search from xml file.
  In order to update or insert new rows in the database you have to access /index.php .
  If the xml file row exists in the database the column date_added will be updated.
  The max length for the chars is 100.
  Ajax is used for filtering result from the search page which can be accessed from /search.php.
  Additional libraries are served through CDN ( jQuery,LessJs )
  If there is any problem with inserting a row in the database an exact error will be displayed ( unvalid xml or unvalid data in the xml).
    
# Database Setup
  In order to recreate the project you have to follow these steps
  1. Create a schema with name public in PostgreSQL
  2. Create table with name books
  3. Create indexes books_pkey 
  4. Create columns in table books 
    id - integer - ID of the book
    author - character varying(100) - Author of the Book	
    book_name - character varying(100)	- Name of the Book
    depth	- integer	- Depth of the xml file
    row_number - integer - Row number of the record in the xml file	
    date_added - timestamp without time zone	- The date that the record was created or updated

# Folder Helpers  
  1. Database.php - The class is used for connection to the database,inserting and updating on the index.php file and filtering for search.php.file
  2. Function.php - Helper functions
  3. XmlValidator.php - Helper class to validate xml.
