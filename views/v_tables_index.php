<p>
    Users's index of tables.
</p>

<!-- The user will need have some options for what tables they can choose from, provided by c_tables_index
Then will need to send the selected table to c_tables_view
    - need to be able to select a table to open
    - need option to create a new table
    - need option to delete an unwanted table
    - need option to clone a table


    -->

<div class ="container">
    <div id = "income_statement">
        <div id = "head">
            <div class = "row-fluid">
                <div class = "span8">
                    <button type="button" onclick="lockValues()">Click to Finalize Income Statement</button>
                </div>
                <div class = "span4">
                    <span class = "editable_field year" title = "Click to Modify">2013</span>
                </div>
            </div>
        </div>

        <div id = "revenue">
            <h4>Revenue</h4>
            <div class = "row-fluid">
                <div class = "span8">
                    <span class = "editable_field">Component</span><br>
                    <span class = "expandable_left">&nbsp;</span>
                    <div>&nbsp;</div>
                    <div><span class = "total summation">Total Revenue</span></div>


                </div>
                <div class = "span4">
                    <span><input placeholder="Revenue" class = "revenue"></span><br>
                    <span class = "expandable_right">[+]</span>
                    <div>&nbsp;</div>
                    <div id = "revenue_sum" class = "calculated_field"><span>Revenue</span></div>
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
