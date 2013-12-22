p4.adamstest.biz
================
Adam Beerman
Project 4

This application is called Quick Sheets.
The purpose is to allow a user to create a database of Income Statements (used for measuring business profitability).
The user has the ability to create new income statements, then view, edit, or delete them.
Edits to the income statements are automatically stored in a database, and subtotals, profits, and profit margins are
updated automatically.
Eventually, this would be extended to have functionality of cloning income statements and creating functions to allow for complex calculations

List of features
* Standard sign-up/login functionality
* Ability to Add a new sheet from the index page (not able to re-name)
* After adding a new sheet, user can view, edit, or delete
* View option will take the user to a specialized view (no option to edit)
* Edit option will take user to a page where they can edit entries
    * Edited entries are automatically stored when user leaves the field
    * Entries are required to be numbers, so any characters will be discarded automatically by a js accounting plugin.
    * From the Edit screen, user can add new entries and delete entries
* Delete option will delete the table and then reload the index page (future javascript functionality)

JavaScript manages:
* the addition of new sheets on the index page
* the updating of the captions on the edit page
* the addition of new rows in the edit page
* automatic database updates on the edit page when a user changes a value
* calculations on the View Page

Additional Information:
* Please note that the accounting.js file was not created by me. I'm using it to handle number formatting.