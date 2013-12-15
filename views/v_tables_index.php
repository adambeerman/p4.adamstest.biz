<br><br>
<div id = "user_table_index">
    <h3><?=$user->first_name ?>'s index of tables</h3>

    <ul>
        <?php foreach($user_tables as $table): ?>
        <li><?=$table['name']?> -
            <a href = '/tables/view/<?=$table['income_table_id']?>'>View</a> |
            <a href = '/tables/edit/<?=$table['income_table_id']?>'>Edit</a> |
            <a href = "/tables/delete/<?=$table['income_table_id']?>">Delete</a>
        </li>
        <?php endforeach; ?>
    </ul>
    <br>
    <div id = "new_table">
        <form>
            <input placeholder="New Table Name" name="name">
            <input type = "submit" value='Create'>
        </form>
    </div>

    <br>
    <br>

</div>

<!-- The user will need have some options for what tables they can choose from, provided by c_tables_index
Then will need to send the selected table to c_tables_view
    - need to be able to select a table to open
    - need option to create a new table
    - need option to delete an unwanted table
    - need option to clone a table


    -->

