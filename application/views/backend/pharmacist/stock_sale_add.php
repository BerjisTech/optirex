<ol class="breadcrumb bc-3" style="margin-bottom: 0px;">
    <li>
        <a href="<?php echo site_url('pharmacist'); ?>">
            <i class="entypo-folder"></i>
            <?php echo get_phrase('dashboard'); ?>
        </a>
    </li>
    <li>
        <a href="<?php echo site_url('pharmacist/stock_sale'); ?>">
            <?php echo get_phrase('stock_sales') ?>
        </a>
    </li>
    <li><?php echo get_phrase('add_stock_sale') ?></li>
</ol>
<br>

<div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <h3><?php echo get_phrase('add_stock_sale'); ?></h3>
                </div>
            </div>

            <div class="panel-body">

                <form role="form" class="form-horizontal form-groups" action="<?php echo site_url('pharmacist/stock_sale/create'); ?>" 
                    method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('patient'); ?></label>

                        <div class="col-sm-6">
                            <select name="patient_id" class="form-control select2" required>
                                <option value=""><?php echo get_phrase('select_a_patient'); ?></option>
                                <?php
                                $patients = $this->db->get('patient')->result_array();
                                foreach ($patients as $row) { ?>
                                    <option value="<?php echo $row['patient_id']; ?>"><?php echo $row['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <span id="stock">
                        <br>
                        <div class="form-group">
                            <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('stocks'); ?></label>

                            <div class="col-sm-4">
                                <select name="stock_id[]" class="form-control select2" onchange="get_available_quantity(this.value, 1)" required>
                                    <option value=""><?php echo get_phrase('select_a_stock'); ?></option>
                                    <?php
                                    $stocks = $this->db->get('stock')->result_array();
                                    foreach ($stocks as $row) {
                                        $available_quantity = $row['total_quantity'] - $row['sold_quantity'];
                                        if($available_quantity > 0) { ?>
                                            <option value="<?php echo $row['stock_id']; ?>">
                                                <?php echo $row['name']; ?>
                                            </option>
                                        <?php }
                                    } ?>
                                </select>
                            </div>

                            <div class="col-sm-2">
                                <input type="number" class="form-control" name="stock_quantity[]" id="stock_quantity_1" min="1" max="999" value="" placeholder="Select Quantity" required/>
                            </div>

                            <div class="col-sm-2">
                                <input type="hidden" class="form-control" id="stock_price_1" value="" readonly />
                            </div>
                        </div>
                    </span>

                    <span id="stock_input">
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-4">
                                <select name="stock_id[]" class="form-control" onchange="get_available_quantity(this.value)" id="stock_id" >
                                    <option value=""><?php echo get_phrase('select_a_stock'); ?></option>
                                    <?php
                                    $stocks = $this->db->get('stock')->result_array();
                                    foreach ($stocks as $row) {
                                        $available_quantity = $row['total_quantity'] - $row['sold_quantity'];
                                        if($available_quantity > 0) { ?>
                                            <option value="<?php echo $row['stock_id']; ?>">
                                                <?php echo $row['name']; ?>
                                            </option>
                                        <?php }
                                    } ?>
                                </select>
                            </div>

                            <div class="col-sm-2">
                                <input type="number" class="form-control" name="stock_quantity[]" id="stock_quantity" min="1" max="999" value="" placeholder="Select Quantity" />
                            </div>

                            <div class="col-sm-2">
                                <button type="button" class="btn btn-danger"
                                    id="stock_delete" onclick="deletestockParentElement(this)">
                                    <i class="fa fa-trash-o"></i>
                                </button>
                            </div>

                            <div class="col-sm-2">
                                <input type="hidden" class="form-control" id="stock_price" value="" readonly />
                            </div>
                        </div>
                    </span>

                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-6">
                            <button type="button" class="btn btn-primary btn-sm" onClick="add_stock()">
                                <i class="fa fa-plus"></i> &nbsp;
                                <?php echo get_phrase('add_stock'); ?>
                            </button>

                            <button type="button" class="btn btn-info btn-sm" onClick="calculate_total_price()">
                                <?php echo get_phrase('calculate_total_price'); ?>
                            </button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('total_price'); ?></label>

                        <div class="col-sm-2">
                            <input type="text" name="total_amount" class="form-control" id="total_amount" value="0" readonly />
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-3">
                            <button id = 'submit_button' type="submit" class="btn btn-success">
                                <i class="fa fa-check"></i> &nbsp; <?php echo get_phrase('add_sale');?>
                            </button>
                        </div>
                    </div>
                </form>

            </div>

        </div>

    </div>
</div>

<script type="text/javascript">

    var stock_count      = 1;
    var total_amount        = 0;
    var deleted_stocks   = [];

    $(document).ready(function(){
      $('#submit_button').attr('disabled', 'true');
    });
    function get_available_quantity(stock_id, append_id)
    {
        if(stock_id != '') {
            $.ajax({
                url     : '<?php echo site_url('pharmacist/get_available_quantity/'); ?>' + stock_id,
                success : function(response)
                {
                    $('#stock_quantity_' + append_id).attr('max', response);
                }
            });

            $.ajax({
                url     : '<?php echo site_url('pharmacist/get_stock_price/'); ?>' + stock_id,
                success : function(response)
                {
                    $('#stock_price_' + append_id).attr('value', response);
                }
            });
        }
    }

    $('#stock_input').hide();

    // CREATING BLANK stock INPUT
    var blank_stock = '';
    $(document).ready(function () {
        blank_stock = $('#stock_input').html();
    });

    function add_stock()
    {
        stock_count++;
        $("#stock").append(blank_stock);

        $('#stock_id').attr('id', 'stock_id_' + stock_count);
        $('#stock_id_' + stock_count).attr('onchange', 'get_available_quantity(this.value, ' + stock_count + ')');

        $('#stock_quantity').attr('id', 'stock_quantity_' + stock_count);
        $('#stock_price').attr('id', 'stock_price_' + stock_count);

        $('#stock_delete').attr('id', 'stock_delete_' + stock_count);
        $('#stock_delete_' + stock_count).attr('onclick', 'deletestockParentElement(this, ' + stock_count + ')');
    }

    // REMOVING stock INPUT
    function deletestockParentElement(n, stock_count) {
        n.parentNode.parentNode.parentNode.removeChild(n.parentNode.parentNode);
        deleted_stocks.push(stock_count);
    }

    function calculate_total_price()
    {
        var amount;
        for(i = 1; i <= stock_count; i++) {
            if(jQuery.inArray(i, deleted_stocks) == -1)
            {
                quantity    = $('#stock_quantity_' + i).val();
                if(quantity == '')
                    quantity = 0;
                amount      = $('#stock_price_' + i).val() * quantity;
                if(amount != '') {
                    amount = parseInt(amount);
                    total_amount = amount + total_amount;
                    $('#total_amount').attr('value', total_amount);
                }
            }
        }
        change_button_attribute();
        total_amount = 0;
    }
    function change_button_attribute(){
      if (total_amount > 0) {
        $('#submit_button').removeAttr('disabled');
      }
      else{
        $('#submit_button').attr('disabled', 'true');
      }
    }

</script>
