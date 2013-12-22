p4.adamstest.biz
================
Adam Beerman
Project 4

My application is called Quick Sheets.
The purpose is to allow a user to create a database of Income Statements for them to edit and view later
Eventually, this would be extended to have functionality of cloning income statements and creating functions to allow for complex calculations

List of features
* Ability to Add a new sheet from the index page
* After adding a new sheet, user can view, edit, or delete
* View will take the user to a specialized view
* Edit will take user to a page where they can edit entries
    * From the Edit screen, they can add new entries, handled through javascript
* Delete will delete the table and then reload the index page (future javascript functionality)

JavaScript manages:
* the adding of new sheets on the index page
* the addition of new rows in the edit page
* AJAX calls on the edit page. Whenever an entry is changed, AJAX updates the database and then computes subtotals
* Calculations on the View Page

Additional Information:
