<div id = "user_table_index">
    <?php if(isset($message)): ?>
        <div class = "error"><?=$message?></div>
    <?php endif; ?>

    <h3><?=$user->first_name ?>'s index of tables</h3>

    <ul>
        <?php foreach($user_tables as $table): ?>
        <li><?=$table['name']?> -
            <a href = '/tables/view/<?=$table['income_table_id']?>'>View</a> |
            <a href = '/tables/edit/<?=$table['income_table_id']?>'>Edit</a> |
            <a href = "/tables/delete/<?=$table['income_table_id']?>">Delete</a>
            <br>
            <small>&nbsp;&nbsp;&nbsp;Last Modified: <?=Time::display($table['modified'])?></small>
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
    <div id = "new_table_status"></div>

    <br>
    <br>

</div>

