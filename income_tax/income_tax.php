<?php
/*
Plugin Name:Income Tax
Description:Income tax Calculator
Author:Neeraj
Plugin URI:https://www.google.com
Version:1.0
*/

register_activation_hook(__FILE__, 'income_tax_activate');
register_deactivation_hook(__FILE__, 'income_tax_dactivate');

function income_tax_activate()
{
  global $wpdb;
  global $table_prefix;
  $table = $table_prefix . 'tax_form';
  $sql = "CREATE TABLE $table (
  `id` int(11) NOT NULL,
  `amount` int(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;ALTER TABLE $table
  ADD PRIMARY KEY (`id`);ALTER TABLE $table
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";
  $wpdb->query($sql);
}



function income_tax_dactivate()
{
  global $wpdb;
  global $table_prefix;
  $table = $table_prefix . 'tax_form';
  $sql = "DROP TABLE $table";
  $wpdb->query($sql);
}

add_action('admin_menu', 'tax_form_data');

function tax_form_data()
{
  add_menu_page('Tax Form', 'Tax Form', 8, __FILE__, 'tax_form_page');
}

function tax_form_page()
{
  include('main.php');
  include('tax_form_page.php');
}
add_shortcode('tax_form_page_shortcode', 'tax_form_page');


function my_plugin_enqueue_styles()
{
  wp_enqueue_style('my-plugin-styles', plugins_url('/css/style_plugin.css', __FILE__));
  wp_enqueue_script('my-plugin-script', plugins_url('/Script_custom_income_plugin.js', __FILE__));
  wp_localize_script('my-plugin-script', 'ajax_var', array(
    'url' => admin_url('admin-ajax.php'),
    'nonce' => wp_create_nonce('ajaxnonce')
  ));
}
add_action('wp_enqueue_scripts', 'my_plugin_enqueue_styles');


add_action('admin_head', 'adminCss');

function adminCss()
{
  wp_enqueue_style('my-plugin-style', plugins_url('/css/style_plugin1.css', __FILE__));
}
add_action('wp_ajax_main', 'ajax_cal');
add_action('wp_ajax_nopriv_main', 'ajax_cal');

function ajax_cal()
{
  // wp_send_json('test');
  $arr = [];
  wp_parse_str($_POST['main'], $arr);

  $year = "";
  $amount = $arr['number'];
  // echo ($amount."hellooo");
  $old_regime = $new_regime = $tax_amount = $nps = $donation = $medical_premium = $basic_80c = $education_loan = $other_income = $income_interest = $income_let_out_rental = $home_loan =
    $interest_saving_amount =  0;
  $other_income = $arr['number1'];
  $income_interest = $arr['number2'];
  $income_let_out_rental = $arr['number3'];
  $home_loan = $arr['number4'];
  // $home_loan_let_out = $_POST['number5'];
  $basic_80c = $arr['deductions1'];


  $nps = $arr['deductions2'];
  $medical_premium = $arr['deductions3'];
  $donation = $arr['deductions4'];
  $education_loan = $arr['deductions5'];
  $interest_saving_amount = $arr['deductions6'];
  $basic_salary_exemption = $arr['exemption1'];
  $DA_exemption = $arr['exemption2'];
  $HRA_exemption = $arr['exemption3'];
  $rentpaid_exemption = $arr['exemption4'];
  // echo $_POST['year'];

  $year = $arr['year'];

  if (
    $other_income != 0 || $income_interest != 0 || $income_let_out_rental != 0 || $home_loan != 0 || $basic_salary_exemption != 0 || $DA_exemption != 0 || $HRA_exemption != 0 || $rentpaid_exemption != 0
  ) {
    $amount += ($other_income + $income_interest + $income_let_out_rental + $home_loan);
    $amount -= ($basic_salary_exemption + $DA_exemption + $HRA_exemption + $rentpaid_exemption);
  }
  if ($amount != null) {
    if (($amount - 50000) > 500000
    ) {

      if (($amount - 50000) > 500000  || $basic_80c != 0 || $nps != 0 || $medical_premium != 0 || $donation != 0 || $education_loan != 0 || $interest_saving_amount != 0) {
        $tax_amount = $amount - 50000;
        $tax_amount;


        if ($basic_80c != 0 && $basic_80c <= 150000) {
          $tax_amount -= $basic_80c;
          if ($tax_amount > 500000) {
            $old_regime = 250000 * 0.05;
          }
        }


        if (
          $nps != 0 && $nps <= 50000
        ) {
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


        if (
          $donation != 0 || $education_loan != 0
        ) {
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
          echo "<p> Old regime = ₹ $old_regime </p> ";

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
          echo "<p>old Regime = ₹ $old_regime</p>";
        } else {
          // echo $old_regime;
          // echo "this is below then 500000   ";
        }
      }
    } else {
      echo "<p class='nontext'> Non Taxable Amount</p>";
    }

    if (
      $arr['year'] == '2022-2023'
    ) {
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
          echo "<p>New Regime = ₹ $new_regime</p>";
        }
        if ($tax_amount_new > 750000 && $tax_amount_new <= 1000000) {
          $new_regime += 250000 * 0.1;
          if ($tax_amount_new) {
            $tax_amount_new -= 750000;

            $new_regime += $tax_amount_new * 0.15;

            $cess = 0.04;
            $new_regime += $new_regime * $cess;
            echo "<p>New Regime 2022-2023 = ₹ $new_regime</p>";
          }
        }
        if ($tax_amount_new > 1000000 && $tax_amount_new <= 1250000) {
          $new_regime += 250000 * 0.1;
          $new_regime += 250000 * 0.15;
          $tax_amount_new -= 1000000;
          $new_regime += $tax_amount_new * 0.2;
          $cess = 0.04;
          $new_regime += $new_regime * $cess;
          echo "<p>New Regime 2022-2023 = ₹ $new_regime</p>";
        }
        if ($tax_amount_new > 1250000 && $tax_amount_new <= 1500000) {
          $new_regime += 250000 * 0.1;
          $new_regime += 250000 * 0.15;
          $new_regime += 250000 * 0.2;
          $tax_amount_new -= 1250000;
          $new_regime += $tax_amount_new * 0.25;
          $cess = 0.04;
          $new_regime += $new_regime * $cess;
          echo "<p> New Regime 2022-2023 = ₹ $new_regime</p>";
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
          echo "<p>New Regime 2022-2023 = ₹ $new_regime</p>";
        }
      }
    }

    if (
      $arr['year'] == '2023-2024'
    ) {
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
          echo "<p>New Regime_2023-2024 = ₹ $new_regime</p>";
        }

        if ($tax_amount_new > 900000  && $tax_amount_new <= 1200000) {
          $new_regime += 300000 * 0.1;
          $tax_amount_new -= 900000;
          $new_regime += $tax_amount_new * 0.15;
          $cess = 0.04;
          $new_regime += $new_regime * $cess;
          echo "<p>New Regime_2023-2024 = ₹ $new_regime</p>";
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
          echo "<p>New Regime_2023-2024 = ₹ $new_regime</p>";
        }
        if ($tax_amount_new > 1500000) {

          $new_regime += 300000 * 0.1;
          $new_regime += 300000 * 0.15;
          $new_regime += 300000 * 0.2;
          $tax_amount_new -= 1500000;
          $new_regime += $tax_amount_new * 0.3;
          $cess = 0.04;
          $new_regime += $new_regime * $cess;
          echo "<p>New Regime_2023-2024 = ₹ $new_regime</p>";
          echo "<br>reached";
        }
      }
    }
    // echo "<br>reached";
  }
  wp_die();
}
