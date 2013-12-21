<!-- The view will look similar to the "edit" page, except there will be no inputs
    # And there will be additional calculations to run the profit margin calculations

    -->

<pre>
    <?php

    //Parse the database query to get an array for each category

    #Initiate category counters
    $r = 0;
    $c = 0;
    $o1 = 0;
    $o2 = 0;

    #Loop through $entry_info and create new arrays from the categories using array_slice
    foreach($entry_info as $i => $entry) {
        switch($entry['category']):
            case 'revenue':
                $revenue[$r] = array_slice($entry,1);
                $r ++;
                break;
            case 'cos':
                $cos[$c] = array_slice($entry,1);
                $c ++;
                break;
            case 'opex':
                $opex[$o1] = array_slice($entry,1);
                $o1 ++;
                break;
            case 'otherex':
                $otherex[$o2] = array_slice($entry,1);
                $o2 ++;
                break;
            default:
                break;
        endswitch;
    }
    ?>
</pre>

<div id = "income_statement" class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><strong><?=$table_info[0]['name']?></strong></h3>
        <h5 id = "caption"><?=$table_info[0]['caption']?></h5>
        <h6>Created: <?=Time::display($table_info[0]['created'])?></h6>
        <h6 id = "last_modified">Last Modified: <?=Time::display($table_info[0]['modified'])?></h6>
    </div>
    <div class="panel-body">
        <div id = "revenue" class = "container">
            <h5>Revenue</h5>
            <?php foreach($revenue as $r_entry): ?>
                <div class = "entry">
                    <span class = "entry_name pull-left">
                        <?php echo $r_entry['name']?>
                    </span>
                    <span class = "pull-right accounting">
                        <?php echo $r_entry['value']?>
                    </span>
                </div>
            <?php endforeach?>
                <div class = "entry calculated_field" id = "revenue_sum">
                    <span class = "total">Total</span>
                    <span class = "pull-right"><strong>Total Revenue</strong></span>
                </div>
            <br>
        </div>


        <div id = "cos" class = "container">
            <h5>Cost of Sales</h5>

            <?php foreach($cos as $c_entry): ?>
                <div class = "entry">
                <span class = "entry_name pull-left">
                    <?php echo $c_entry['name']?>
                </span>
                <span class = "pull-right accounting">
                    <?php echo $c_entry['value']?>
                </span>
                </div>
            <?php endforeach?>

            <div class = "entry calculated_field" id = "cos_sum">
                <span class = "total">Total</span>
                <span class = "pull-right"><strong>Total Cost of Sales</strong></span>
            </div>
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

        <div id = "opex" class = "container">
            <h5>Operating Expenses</h5>
            <?php foreach($opex as $o1_entry): ?>
                <div class = "entry">
                <span class = "entry_name pull-left">
                    <?php echo $o1_entry['name']?>
                </span>
                <span class = "pull-right accounting">
                    <?php echo $o1_entry['value']?>
                </span>
                </div>
            <?php endforeach?>

            <div class = "entry calculated_field" id = "opex_sum">
                <span class = "total">Total</span>
                <span class = "pull-right"><strong>Total Operating Expenses</strong></span>
            </div>
        </div>

        <div id = "otherex" class = "container">
            <h5>Other Expenses</h5>
            <?php foreach($otherex as $o2_entry): ?>
                <div class = "entry">
                <span class = "entry_name pull-left">
                    <?php echo $o2_entry['name']?>
                </span>
                <span class = "pull-right accounting">
                    <?php echo $o2_entry['value']?>
                </span>
                </div>
            <?php endforeach?>
            <div class = "entry calculated_field" id = "otherex_sum">
                <span class = "total">Total</span>
                <span class = "pull-right"><strong>Total Other Expenses</strong></span>
            </div>
        </div>
    </div>
</div>