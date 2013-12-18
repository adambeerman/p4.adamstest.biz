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
                    <span class = "pull-right">Total Operating Expenses</span>
                </div>
            </form>
        </div>
    </div>
</div>



<div class ="container">
    <div id = "income_statement">
        <div id = "head">
            <div class = "row-fluid">
                <div class = "span8">
                </div>
                <div class = "span4">
                    <span class = "editable_field year" title = "Click to Modify">2013</span>
                </div>
            </div>
        </div>

        <div>
            <h4>Revenue</h4>


            <div class = "row-fluid">
                <div class = "span8">
                    <span class = "editable_field">Component</span><br>
                    <span class = "expandable_left">&nbsp;</span>
                    <div>&nbsp;</div>
                    <div><span class = "total summation">Total Revenue</span></div>


                </div>
                <div class = "span4">
                    <form id = "revenue">
                        <span><input placeholder="Revenue" class = "revenue" name = "revenue[0]"></span><br>
                        <span class = "expandable_right">[+]</span>
                        <div>&nbsp;</div>
                        <div id = "revenue_sum" class = "calculated_field"><span>Revenue</span></div>
                    </form>

                </div>
            </div>
        </div>

        <div id = "cos">
            <h4>Cost of Goods Sold</h4>
            <div class = "row-fluid">
                <div class = "span8">
                    <span class = "editable_field">Component</span><br>
                    <span class = "expandable_left">&nbsp;</span>
                    <div>&nbsp;</div>
                    <div><span class = "total summation">Total Cost of Goods Sold</span></div>
                </div>
                <div class = "span4">
                    <span><input placeholder="Cost of Goods" class = "cos"></span><br>
                    <span class = "expandable_right">[+]</span>
                    <div>&nbsp;</div>
                    <div id = "cos_sum" class = "calculated_field"><span>Total Cost of Goods</span></div>
                </div>
            </div>
        </div>

        <div id = "gross">
            <h4></h4>
            <div class = "row-fluid">
                <div class = "span8 italic">
                    <span>Gross Profit</span><br>
                    <span>Gross Margin</span>
                </div>
                <div class = "span4 italic">
                    <span id = "gross_profit" class = "calculated_field">Gross Profit</span><br>
                    <span id = "gross_margin" class = "calculated_field">Gross Margin</span>
                </div>
            </div>
        </div>

        <div id = "opex">
            <h4>Operating Expenses</h4>
            <div class = "row-fluid">
                <div class = "span8">
                    <span class = "editable_field">Component</span><br>
                    <span class = "expandable_left">&nbsp;</span>
                    <div>&nbsp;</div>
                    <div><span class = "total summation">Total Operating Expenses</span></div>
                </div>
                <div class = "span4">
                    <span><input placeholder="Op Ex" class = "opex"></span><br>
                    <span class = "expandable_right">[+]</span>
                    <div>&nbsp;</div>
                    <div id = "opex_sum" class = "calculated_field"><span>Op Ex</span></div>
                </div>
            </div>
        </div>

        <div id = "op">
            <h4></h4>
            <div class = "row-fluid">
                <div class = "span8 italic">
                    <span>Operating Profit</span><br>
                    <span>Operating Margin</span>
                </div>
                <div class = "span4 italic">
                    <span id = "op_profit" class = "calculated_field">Operating Profit</span><br>
                    <span id = "op_margin" class = "calculated_field">Operating Margin</span>
                </div>
            </div>
        </div>

        <div id = "otherex">
            <h4>Other Expenses</h4>
            <div class = "row-fluid">
                <div class = "span8">
                    <span class = "editable_field">Component</span><br>
                    <span class = "expandable_left">&nbsp;</span>
                    <div>&nbsp;</div>
                    <div><span class = "total summation">Total Other Expenses</span></div>
                </div>
                <div class = "span4">
                    <span><input placeholder="Other Expenses" class = "otherex"></span><br>
                    <span class = "expandable_right">[+]</span>
                    <div>&nbsp;</div>
                    <div id = "otherex_sum" class = "calculated_field"><span>Other Expenses</span></div>
                </div>
            </div>
        </div>

        <div id = "net">
            <h4></h4>
            <div class = "row-fluid">
                <div class = "span8 italic">
                    <span>Net Profit</span><br>
                    <span>Net Margin</span>
                </div>
                <div class = "span4 italic">
                    <span id = "net_profit" class = "calculated_field">Net Profit</span><br>
                    <span id = "net_margin" class = "calculated_field">Net Margin</span>
                </div>
            </div>
        </div>
        <div id = "foot">
            <button type="button" onclick="lockValues()">Finalize Income Statement</button>
        </div>
    </div>
</div>