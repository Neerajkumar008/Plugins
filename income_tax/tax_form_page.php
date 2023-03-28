<body>
    <div class="container_plugin">
        <h1>Income Tax Calculator</h1>
        <div class="form_tax">


            <form action="" method="post" id="tax_form" name="tax_form">
                <div class="year_select">
                    <label for="Year"> Assessment Year</label>
                    <select name="year">
                        <option value="2020-2021" <?php if ($year != '' && $year == "2020-2021") {
                                                        echo 'selected = "selected"';
                                                    }  ?>>2020-2021</option>
                        <option value="2021-2022" <?php if ($year != '' && $year == "2021-2022") {
                                                        echo 'selected = "selected"';
                                                    } ?>>2021-2022</option>
                        <option value="2022-2023" <?php if ($year != '' && $year == "2022-2023") {
                                                        echo 'selected = "selected"';
                                                    } ?>>2022-2023</option>
                        <option value="2023-2024" <?php if ($year != '' && $year == "2023-2024") {
                                                        echo 'selected = "selected"';
                                                    } ?>>2023-2024</option>
                    </select>
                </div>

                <div class="age_select">
                    <label for="age_category">Age category</label>
                    <select id="age_category">
                        <option value="59">Below 60</option>
                        <option value="79">60 or Above 60</option>
                        <option value="80">80 or Above 80</option>
                    </select>
                </div>

                <div class="income">
                    <h3>Income</h3>
                    <div>
                        Gross salary income <input type="number" value="<?php echo isset($_POST['number']) ? $_POST['number'] : "0" ?>" name="number">
                    </div>
                    <div>
                        Annual income from other sources <input type="number" value="<?php echo isset($_POST['number1']) ? $_POST['number1'] : "0" ?>" name="number1">
                    </div>
                    <div>
                        Annual income from interest <input type="number" value="<?php echo isset($_POST['number2']) ? $_POST['number2'] : "0" ?>" name="number2">
                    </div>
                    <div>
                        Annual income from let-out house property (rental income) <input type="number" value="<?php echo isset($_POST['number3']) ? $_POST['number3'] : "0" ?>" name="number3">
                    </div>
                    <div>
                        Annual interest paid on home loan (self-occupied) <input type="number" value="<?php echo isset($_POST['number4']) ? $_POST['number4'] : "0" ?>" name="number4">
                    </div>
                    Annual interest paid on home loan (let-out) <input type="number" name="number5">
                </div>

                <div class="deductions">
                    <h3>Deductions</h3>
                    <div>
                        Basic deductions u/s 80C<input type="number" value="<?php echo isset($_POST['deductions1']) ? $_POST['deductions1'] : "0" ?>" name="deductions1">
                    </div>
                    <div>
                        Contribution to NPS u/s 80CCD(1B)<input type="number" value="<?php echo isset($_POST['deductions2']) ? $_POST['deductions2'] : "0" ?>" name="deductions2">
                    </div>
                    <div>
                        Medical Insurance Premium u/s 80D<input type="number" value="<?php echo isset($_POST['deductions3']) ? $_POST['deductions3'] : "0" ?>" name="deductions3">
                    </div>
                    <div>
                        Donation to charity u/s 80G<input type="number" value="<?php echo isset($_POST['deductions4']) ? $_POST['deductions4'] : "0" ?>" name="deductions4">
                    </div>
                    <div>
                        Interest on Educational Loan u/s 80E<input type="number" value="<?php echo isset($_POST['deductions5']) ? $_POST['deductions5'] : "0" ?>" name="deductions5">
                    </div>
                    <div>
                        Interest on deposits in saving account u/s 80TTA/TTB<input type="number" value="<?php echo isset($_POST['deductions6']) ? $_POST['deductions6'] : "0" ?>" name="deductions6">
                    </div>
                </div>

                <div class="hra_exemption">
                    <h3>HRA Exemption</h3>
                    <div>
                        Basic salary received per annum <input type="number" value="0" name="exemption1">
                    </div>
                    <div>
                        Dearness allowance (DA) received per annum <input type="number" value="0" name="exemption2">
                    </div>
                    <div>
                        HRA received per annum <input type="number" value="0" name="exemption3">
                    </div>
                    <div>
                        Total rent paid per annum<input type="number" value="0" name="exemption4">
                    </div>
                </div>

                <input type="submit" class="btn_plugin" name="submit" value="Calculator">

                <div class="results_data" id="results_data">
                    <div>
                        <p class="old_reg_sa"></p>
                    </div>
                    <div>
                        <p class="new_reg_sa"></p>
                    </div>
                    <div>
                        <p class="non_tax_amount"></p>
                    </div>
                </div>
            </form>
        </div>
    </div>

</body>