// jQuery(document).ready(function(){
// var old_reg = jQuery('.old_reg').text();
// var new_reg = jQuery('.new_reg').text();
// var non_tax_payer = jQuery('.nontext').text();
// console.log(old_reg);
// console.log(new_reg);
// jQuery('.old_reg_sa').html(old_reg);
// jQuery('.new_reg_sa').html(new_reg);
// jQuery('.non_tax_amount').html(non_tax_payer);
 
// });

// jQuery(document).ready(function() {
//         jQuery('#tax_form').submit(function(event) {
//             event.preventDefault();
//             // alert('a');
//             var link = '<?php echo admin_url("admin-ajax.php") ?>';
//             var form = jQuery('#tax_form').serialize();
//             console.log(form);

//             var formData = new FormData;
//             formData.append('action', 'main');
//             formData.append('main', form);
//             console.log(formData);
//             jQuery.ajax({
//                 url: link,
//                 method: 'post',
//                 processData: false,
//                 contentType: false,
//                 data: formData,
//                 success: function(result) {
//                     console.log("entered")
//                     jQuery('#results_data').html(result);

//                 }
//             })
//         });
//     });