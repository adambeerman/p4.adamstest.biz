<div class = "container">
    <h3>Welcome to Quicksheets</h3>

    <h4>
        by Adam Beerman
        Project 4 for CSCI E-15
    </h4>

    <p>
        This application is called Quick Sheets.
        The purpose is to allow a user to create a database of Income Statements (used for measuring business profitability).
        The user has the ability to create new income statements, then view, edit, or delete them.
        Edits to the income statements are automatically stored in a database, and subtotals, profits, and profit margins are
        updated automatically.
        Eventually, this would be extended to have functionality of cloning income statements and creating functions to allow for complex calculations
    </p>
    <p>
        List of features
        <ul>
        <li>Standard sign-up/login functionality</li>
        <li>Ability to Add a new sheet from the index page (not able to re-name)</li>
        <li>After adding a new sheet, user can view, edit, or delete</li>
        <li>View option will take the user to a specialized view (no option to edit)</li>
        <li>Edit option will take user to a page where they can edit entries</li>
        <li>Edited entries are automatically stored when user leaves the field</li>
        <li>Entries are required to be numbers, so any characters will be discarded automatically by a js accounting plugin.</li>
        <li>From the Edit screen, user can add new entries and delete entries</li>
        <li>Delete option will delete the table and then reload the index page (future javascript functionality)</li>
        </ul>

    </p>
    <p>
        Javascript manages:
        <ul>
        <li>the addition of new sheets on the index page</li>
        <li>the updating of the captions on the edit page</li>
        <li>the addition of new rows in the edit page</li>
        <li>automatic database updates on the edit page when a user changes a value</li>
        <li>calculations on the View page</li>
        </ul>
    </p>
</div>
