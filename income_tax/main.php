<?php
$year = "";
if (isset($_POST['submit'])) {
    $amount = $_POST['number'];
    $old_regime = $new_regime = $tax_amount = $nps = $donation = $medical_premium = $basic_80c = $education_loan = $other_income = $income_interest = $income_let_out_rental = $home_loan =
        $interest_saving_amount =  0;
    $other_income = $_POST['number1'];
    $income_interest = $_POST['number2'];
    $income_let_out_rental = $_POST['number3'];
    $home_loan = $_POST['number4'];
    // $home_loan_let_out = $_POST['number5'];
    $basic_80c = $_POST['deductions1'];

    $nps = $_POST['deductions2'];
    $medical_premium = $_POST['deductions3'];
    $donation = $_POST['deductions4'];
    $education_loan = $_POST['deductions5'];
    $interest_saving_amount = $_POST['deductions6'];
    $basic_salary_exemption = $_POST['exemption1'];
    $DA_exemption = $_POST['exemption2'];
    $HRA_exemption = $_POST['exemption3'];
    $rentpaid_exemption = $_POST['exemption4'];
    // echo $_POST['year'];

    $year = $_POST['year'];
    if ($other_income != 0 || $income_interest != 0 || $income_let_out_rental != 0 || $home_loan != 0 || $basic_salary_exemption != 0 || $DA_exemption != 0 || $HRA_exemption != 0 || $rentpaid_exemption != 0) {
        // echo $other_income;
        $amount += ($other_income + $income_interest + $income_let_out_rental + $home_loan);
        $amount -= ($basic_salary_exemption + $DA_exemption + $HRA_exemption + $rentpaid_exemption);
    }
    if ($amount != null) {
        if (($amount - 50000) > 500000) {

            if (($amount - 50000) > 500000  || $basic_80c != 0 || $nps != 0 || $medical_premium != 0 || $donation != 0 || $education_loan != 0 || $interest_saving_amount != 0) {
                $tax_amount = $amount - 50000;
                $tax_amount;


                if ($basic_80c != 0 && $basic_80c <= 150000) {
                    $tax_amount -= $basic_80c;
                    if ($tax_amount > 500000) {
                        $old_regime = 250000 * 0.05;
                    }
                }


                if ($nps != 0 && $nps <= 50000) {
                    $tax_amount -= $nps;
                    if ($tax_amount > 500000) {
                        $old_regime = 250000 * 0.05;
                    }
                }


                if ($medical_premium != 0 && $medical_premium <= 25000) {
                    $tax_amount -= $medical_premium;
                    if ($tax_amount > 500000) {
                        $old_regime = 250000 * 0.05;
                    }
                }


                if ($donation != 0 || $education_loan != 0) {
                    if ($donation != 0) {
                        $tax_amount -= $donation;
                        if ($tax_amount > 500000) {
                            $old_regime = 250000 * 0.05;
                        }
                    }
                    if ($education_loan != 0) {
                        $tax_amount -= $education_loan;
                        if ($tax_amount > 500000) {
                            $old_regime = 250000 * 0.05;
                        }
                    }
                }

                if ($interest_saving_amount != 0 && $interest_saving_amount <= 10000) {
                    $tax_amount -= $interest_saving_amount;
                    if ($tax_amount > 500000) {
                        $old_regime = 250000 * 0.05;
                    }
                }
                if ($tax_amount > 500000) {
                    $old_regime = 250000 * 0.05;
                }

                if ($tax_amount > 500000 && $tax_amount <= 1000000) {
                    // echo "innner then 2";
                    $tax_amount -= 500000;
                    $old_regime += $tax_amount * 0.2;
                    $cess = 0.04;
                    $old_regime += floor($old_regime * $cess);
                    echo "<p class='old_reg'> Old regime = &#8377 $old_regime </p> ";

                    // echo "<br> $tax_amount <br>";
                }
                if ($tax_amount > 1000000) {
                    $old_regime += (500000 * 0.2);
                    $tax_amount -= 1000000;
                    if ($tax_amount != 0) {
                        $old_regime += $tax_amount * 0.3;
                    }
                    $cess = 0.04;
                    $old_regime += floor($old_regime * $cess);
                    echo "<p class='old_reg'>old Regime = &#8377 $old_regime</p>";
                } else {
                    // echo $old_regime;
                    // echo "this is below then 500000   ";
                }
            }
        } else {
            echo "<p class='nontext'> Non Taxable Amount</p>";
        }

        if ($_POST['year'] == '2022-2023') {
            // echo "year 2022";
            if (($amount) >= 700000) {
                if ($amount != 0) {

                    $tax_amount_new = $amount;
                    $new_regime = 250000 * 0.05;
                }
                if ($tax_amount_new > 500000 && $tax_amount_new <= 750000) {
                    $tax_amount_new -= 500000;
                    // echo $tax_amount_new;
                    $new_regime += $tax_amount_new * 0.1;
                    $cess = 0.04;
                    $new_regime += $new_regime * $cess;
                    echo "<p class='new_reg'>New Regime = &#8377 $new_regime</p>";
                }
                if ($tax_amount_new > 750000 && $tax_amount_new <= 1000000) {
                    $new_regime += 250000 * 0.1;
                    if ($tax_amount_new) {
                        $tax_amount_new -= 750000;

                        $new_regime += $tax_amount_new * 0.15;

                        $cess = 0.04;
                        $new_regime += $new_regime * $cess;
                        echo "<p class='new_reg'>New Regime 2022-2023 = &#8377 $new_regime</p>";
                    }
                }
                if ($tax_amount_new > 1000000 && $tax_amount_new <= 1250000) {
                    $new_regime += 250000 * 0.1;
                    $new_regime += 250000 * 0.15;
                    $tax_amount_new -= 1000000;
                    $new_regime += $tax_amount_new * 0.2;
                    $cess = 0.04;
                    $new_regime += $new_regime * $cess;
                    echo "<p class = 'new_reg'>New Regime 2022-2023 = &#8377 $new_regime</p>";
                }
                if ($tax_amount_new > 1250000 && $tax_amount_new <= 1500000) {
                    $new_regime += 250000 * 0.1;
                    $new_regime += 250000 * 0.15;
                    $new_regime += 250000 * 0.2;
                    $tax_amount_new -= 1250000;
                    $new_regime += $tax_amount_new * 0.25;
                    $cess = 0.04;
                    $new_regime += $new_regime * $cess;
                    echo "<p class='new_reg'> New Regime 2022-2023 = &#8377 $new_regime</p>";
                }
                if ($tax_amount_new > 1500000) {
                    $new_regime += 250000 * 0.1;
                    $new_regime += 250000 * 0.15;
                    $new_regime += 250000 * 0.2;
                    $new_regime += 250000 * 0.25;
                    $tax_amount_new -= 1500000;
                    $new_regime += $tax_amount_new * 0.3;
                    $cess = 0.04;
                    $new_regime += $new_regime * $cess;
                    echo "<p class='new_reg'>New Regime 2022-2023 = &#8377 $new_regime</p>";
                }
            }
        }

        if ($_POST['year'] == '2023-2024') {
            if (($amount - 50000) >= 700000) {
                if ($amount != 0) {
                    $tax_amount_new = $amount - 50000;
                    $new_regime = 300000 * 0.05;
                }
                if ($tax_amount_new > 600000 && $tax_amount_new <= 900000) {
                    $tax_amount_new -= 600000;
                    // echo $tax_amount_new;
                    $new_regime += $tax_amount_new * 0.1;
                    $cess = 0.04;
                    $new_regime += $new_regime * $cess;
                    echo "<p class='new_reg'>New Regime_2023-2024 = &#8377 $new_regime</p>";
                }

                if ($tax_amount_new > 900000  && $tax_amount_new <= 1200000) {
                    $new_regime += 300000 * 0.1;
                    $tax_amount_new -= 900000;
                    $new_regime += $tax_amount_new * 0.15;
                    $cess = 0.04;
                    $new_regime += $new_regime * $cess;
                    echo "<p class='new_reg'>New Regime_2023-2024 = &#8377 $new_regime</p>";
                }
                if ($tax_amount_new > 1200000  && $tax_amount_new <= 1500000) {
                    $new_regime += (300000 * 0.1);
                    // echo "<br> $new_regime";

                    $new_regime += 300000 * 0.15;
                    // echo "<br> $new_regime";
                    $tax_amount_new -= 1200000;
                    $new_regime += $tax_amount_new * 0.2;
                    $cess = 0.04;
                    $new_regime += $new_regime * $cess;
                    echo "<p class='new_reg'>New Regime_2023-2024 = &#8377 $new_regime</p>";
                }
                if ($tax_amount_new > 1500000) {

                    $new_regime += 300000 * 0.1;
                    $new_regime += 300000 * 0.15;
                    $new_regime += 300000 * 0.2;
                    $tax_amount_new -= 1500000;
                    $new_regime += $tax_amount_new * 0.3;
                    $cess = 0.04;
                    $new_regime += $new_regime * $cess;
                    echo "<p class='new_reg'>New Regime_2023-2024 = &#8377 $new_regime</p>";
                }
            }
        }
    }
}

?>


<script>
    jQuery(document).ready(function() {
        jQuery('#tax_form').submit(function(event) {
            event.preventDefault();

            var link = ajax_var.url;

            var form = jQuery('#tax_form').serialize();
            console.log(form);

            var formData = new FormData;
            formData.append('action', 'main');
            formData.append('main', form);
            console.log(formData);
            jQuery.ajax({
                url: link,
                method: 'post',
                processData: false,
                contentType: false,
                data: formData,
                success: function(result) {
                    console.log("entered")
                    jQuery('#results_data').html(result);
                }
            })
        });
    });
</script>