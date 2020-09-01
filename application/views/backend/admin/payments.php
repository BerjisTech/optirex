<div class="row">
    <?php
$edit_data = $this->db->get_where('invoice', array('invoice_id' => $invoice_id))->result_array();
foreach ($edit_data as $row):
?>
    <div class="col-sm-8 tile-stats tile-white-red" id="invoice_print">
        <table class="col-xs-12">
            <tr>
                <td width="50%"><img src="<?php echo base_url(); ?>uploads/logo.png" style="max-height:80px;"></td>
                <td align="right">
                    <h4><?php echo get_phrase('invoice_number'); ?> : <?php echo $row['invoice_number']; ?></h4>
                    <h5><?php echo get_phrase('issue_date'); ?> : <?php echo $row['creation_timestamp']; ?></h5>
                    <h5><?php echo get_phrase('due_date'); ?> : <?php echo $row['due_timestamp']; ?></h5>
                    <h5><?php echo get_phrase('status'); ?> : <?php echo $row['status']; ?></h5>
                </td>
            </tr>
            <tr>
                <td align="left">
                    <h4><?php echo get_phrase('payment_to'); ?> </h4>
                </td>
                <td align="right">
                    <h4><?php echo get_phrase('bill_to'); ?> </h4>
                </td>
            </tr>

            <tr>
                <td align="left" valign="top">
                    <?php echo $this->db->get_where('settings', array('type' => 'system_name'))->row()->description; ?><br>
                    <?php echo $this->db->get_where('settings', array('type' => 'address'))->row()->description; ?><br>
                    <?php echo $this->db->get_where('settings', array('type' => 'phone'))->row()->description; ?><br>
                </td>
                <td align="right" valign="top">
                    <?php echo $this->db->get_where('patient', array('patient_id' => $row['patient_id']))->row()->name; ?><br>
                    <?php echo $this->db->get_where('patient', array('patient_id' => $row['patient_id']))->row()->address; ?><br>
                    <?php echo $this->db->get_where('patient', array('patient_id' => $row['patient_id']))->row()->phone; ?><br>
                </td>
            </tr>
        </table>
        <hr>
        <h4><?php echo get_phrase('invoice_entries'); ?></h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th width="60%"><?php echo get_phrase('entry'); ?></th>
                    <th><?php echo get_phrase('price'); ?></th>
                </tr>
            </thead>

            <tbody id="invoice_entry">
                <?php
                $system_currency_id = $this->db->get_where('settings', array('type' => 'system_currency_id'))->row()->description;
                $currency_symbol    = $this->db->get_where('currency', array('currency_id' => $system_currency_id))->row()->currency_symbol;
                $total_amount       = 0;
                $invoice_entries    = json_decode($row['invoice_entries']);
                $i = 1;
                foreach ($invoice_entries as $invoice_entry)
                {
                    $total_amount += $invoice_entry->amount; ?>
                <tr>
                    <td class="text-center"><?php echo $i++; ?></td>
                    <td>
                        <?php echo $invoice_entry->description; ?>
                    </td>
                    <td class="text-right">
                        <?php echo $currency_symbol . $invoice_entry->amount; ?>
                    </td>
                </tr>
                <?php } 
                $grand_total = $this->crud_model->calculate_invoice_total_amount($row['invoice_number']); ?>
            </tbody>
        </table>
        <table class="col-xs-12">
            <tr>
                <td align="right" width="80%"><?php echo get_phrase('sub_total'); ?> :</td>
                <td align="right"><?php echo $currency_symbol . $total_amount; ?></td>
            </tr>
            <tr>
                <td align="right" width="80%"><?php echo get_phrase('vat_percentage'); ?> :</td>
                <td align="right"><?php echo $row['vat_percentage']; ?>% </td>
            </tr>
            <tr>
                <td align="right" width="80%"><?php echo get_phrase('discount'); ?> :</td>
                <td align="right"><?php echo $currency_symbol . $row['discount_amount']; ?> </td>
            </tr>
            <tr>
                <td colspan="2">
                    <hr style="margin:0px;">
                </td>
            </tr>
            <tr>
                <td align="right" width="80%">
                    <h4><?php echo get_phrase('grand_total'); ?> :</h4>
                </td>
                <td align="right">
                    <h4><?php echo $currency_symbol . $grand_total; ?> </h4>
                </td>
            </tr>
        </table>
    </div>
    <div class="col-sm-4">
        <div class="tile-stats tile-white-red">
            <div class="icon"><i class="fa fa-money"></i></div>
            <div class="num">
                PAY
            </div>
            <?php if($this->session->flashdata('message')){ ?>
            <div id="flash_message" class='col-md-8 offset-md-2'>
                <p class="alert alert-<?=$this->session->flashdata('message_type');?>">
                    <?=$this->session->flashdata('message');?></p>
            </div>
            <?php } ?>
            <form action='<?=base_url("payments/create_transaction");?>' method='post'>
                <input type="hidden" name="invoice_id" value="<?php echo $invoice_id; ?>" />
                <input type="hidden" name="payment_type" value="medicine" />
                <label>Customer Email <span class='text-danger'>*</span></label>
                <input type='text' name='customer_email' class='form-control'
                    value="<?php echo $this->db->get_where('patient', array('patient_id' => $row['patient_id']))->row()->email; ?>"
                    required /><br>

                <label>Amount <span class='text-danger'>*</span></label>
                <input type='text' name='amount' class='form-control' value="<?php echo $grand_total; ?>" required /><br>

                <label>Currency <span class='text-danger'>*</span></label>
                <input type='text' name='currency' value='KES' readonly class='form-control' /><br>

                <label>Payment Plan ID [ Set your product / plan ID for recurring payments if any ]</label>
                <input type='text' name='payment_plan' value='' class='form-control' /><br>

                <br><br>
                <input type='submit' class='btn btn-success' value='Make payment' />

            </form>
        </div>
    </div>


    <?php endforeach; ?>




    <script type="text/javascript">
    function PrintElem(elem) {
        Popup($(elem).html());
    }

    function Popup(data) {
        var mywindow = window.open('', 'invoice', 'height=400,width=600');
        mywindow.document.write('<html><head><title>Invoice</title>');
        mywindow.document.write('<link rel="stylesheet" href="assets/css/neon-theme.css" type="text/css" />');
        mywindow.document.write(
            '<link rel="stylesheet" href="assets/js/datatables/responsive/css/datatables.responsive.css" type="text/css" />'
        );
        mywindow.document.write('</head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

        mywindow.print();
        mywindow.close();

        return true;
    }
    </script>
</div>