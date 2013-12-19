<!--

    - Needs to populate table with information in the database, provided by c_tables_view
    - should have the standard categories (Revenue, COS, Op_Ex, and Other_Ex)

    -->
<?php $_POST['income_table_id'] = $table_id; ?>

<div id = "income_statement" class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><strong><?=$table_info[0]['name']?></strong></h3>
        <?php if((strlen($table_info[0]['caption']))>0): ?>
            <h5 id = "caption"><?=$table_info[0]['caption']?></h5>
        <?php else: ?>
            <h5 id = "caption" class = "blue_text">[Add Caption]</h5>
        <?php endif ?>
        <h5 id = "caption_form">
            <form id = "caption_update">
                <input placeholder="Update Caption" name="caption">
                <input class = "hidden" name = "income_table_id" value="<?=$table_info[0]['income_table_id']?>">
                <input type = "submit" value='Update'>
            </form>
        </h5>

        <h6>Created: <?=Time::display($table_info[0]['created'])?></h6>
        <h6 id = "last_modified">Last Modified: <?=Time::display($table_info[0]['modified'])?></h6>
    </div>


    <div class="panel-body">

        <div id = "revenue_div" class = "container">
            <h5>Revenue</h5>
            <form id = "revenue">
                <input class = "hidden" name = "income_table_id" value="<?=$table_info[0]['income_table_id']?>">
                <div class = "entry">
                    <span class = "entry_name pull-left">
                        <input placeholder="Revenue Component Name" name = "revenueName[0]">
                    </span>
                    <span class = "pull-right">
                        <input placeholder="Revenue" class = "accounting" name = "revenue[0]">
                    </span>
                </div>

                <div class = "expand">
                    <span pull-right">[+]</span>
                    <br>
                </div>
                <div class = "entry calculated_field" id = "revenue_sum">
                    <span class = "total">Total</span>
                    <span class = "pull-right">Total Revenue</span>
                </div>
            </form>
            <br>
        </div>


        <div id = "cos_div" class = "container">
            <h5>Cost of Sales</h5>
            <form id = "cos">
                <div class = "entry">
                    <span class = "entry_name pull-left">
                        <input placeholder="Cost of Sales Component Name" name = "cosName[0]">
                    </span>
                    <span class = "pull-right">
                        <input placeholder="Cost of Sales" class = "accounting" name = "cos[0]">
                    </span>
                </div>

                <div class = "expand">
                    <span pull-right">[+]</span>
                    <br>
                </div>
                <div class = "entry calculated_field" id = "cos_sum">
                    <div class = "total">Total</div>
                    <div class = "pull-right">Total Cost of Sales</div>
                </div>
            </form>
            <br>
        </div>

        <div id = "gross" class = "container">
            <div class = "entry italic">
                <div class = "calc_name" title = "Net of Revenue less Cost of Sales">
                    Gross Profit
                </div>
                <div id = "gross_profit" class = "calculated_field">
                    Gross Profit
                </div>
            </div>

            <div class = "entry italic">
                <div class = "calc_name" title = "Gross Profit / Revenue">
                    Gross Margin
                </div>
                <div id = "gross_margin" class = "calculated_field">
                    Gross Margin
                </div>
            </div>
        </div>

        <div id = "opex_div" class = "container">
            <h5>Operating Expenses</h5>
            <form id = "opex">
                <div class = "entry">
                    <span class = "entry_name pull-left">
                        <input placeholder="Op Ex Component Name" name = "opexName[0]">
                    </span>
                    <span class = "pull-right">
                        <input placeholder="Operating Expense" class = "accounting" name = "opex[0]">
                    </span>
                </div>

                <div class = "expand">
                    <span pull-right">[+]</span>
                    <br>
                </div>
                <div class = "entry calculated_field" id = "opex_sum">
                    <span class = "total">Total</span>
                    <span class = "pull-right">Total Operating Expenses</span>
                </div>
            </form>
        </div>

        <div id = "otherex_div" class = "container">
            <h5>Other Expenses</h5>
            <form id = "otherex">
                <div class = "entry">
                    <span class = "entry_name pull-left">
                        <input placeholder="Other Expense Component Name" name = "otherexName[0]">
                    </span>
                    <span class = "pull-right">
                        <input placeholder="Other Expense" class = "accounting" name = "otherex[0]">
                    </span>
                </div>

                <div class = "expand">
                    <span pull-right">[+]</span>
                    <br>
                </div>
                <div class = "entry calculated_field" id = "otherex_sum">
                    <span class = "total">Total</span>
                    <span class = "pull-right">Total Other Expenses</span>
                </div>
            </form>
        </div>
    </div>
</div>