<a href="<?php echo site_url('pharmacist/create_stock_sale'); ?>"
    class="btn btn-primary pull-right">
        <i class="fa fa-plus"></i> &nbsp;<?php echo get_phrase('add_stock_sale'); ?>
</a>
<div style="clear:both;"></div>
<br>
<table class="table table-bordered table-striped datatable" id="table-2">
    <thead>
        <tr>
            <th style="width: 67px;">#</th>
            <th><?php echo get_phrase('stocks'); ?></th>
            <th><?php echo get_phrase('total_price'); ?></th>
            <th><?php echo get_phrase('patient'); ?></th>
            <th><?php echo get_phrase('options'); ?></th>
        </tr>
    </thead>

    <tbody>
        <?php
        $counter        = 1;
        $this->db->order_by('stock_sale_id', 'desc');
        $stock_sales = $this->db->get('stock_sale')->result_array();
        foreach ($stock_sales as $row) { ?>   
            <tr>
                <td><?php echo $counter++; ?></td>
                <td>
                    <div>
                        <table style="width: 100%;">
                            <tr>
                                <td style="text-align: center;"><?php echo get_phrase('stock_name'); ?></td>
                                <td style="text-align: center;"><?php echo get_phrase('quantity'); ?></td>
                                <td style="text-align: center;"><?php echo get_phrase('price'); ?></td>
                            </tr>
                            <tr>
                                <td colspan="4"><hr style="margin: 5px 0px;"></td>
                            </tr>
                            <?php
                            $stocks      = json_decode($row['stocks']);
                            foreach($stocks as $row2) { ?>
                                <tr>
                                    <td style="text-align: center;">
                                        <?php
                                        $stock_info = $this->db->get_where('stock', array('stock_id' => $row2->stock_id))->row();
                                        echo $stock_info->name; ?>
                                    </td>
                                    <td style="text-align: center;"><?php echo $row2->quantity; ?></td>
                                    <td style="text-align: center;"><?php echo $row2->quantity * $stock_info->price; ?></td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                </td>
                <td><?php echo $row['total_amount'] ?></td>
                <td>
                    <?php echo $this->db->get_where('patient', array('patient_id' => $row['patient_id']))->row()->name; ?>
                </td>
                <td>
                    <a onclick="showAjaxModal('<?php echo site_url('modal/popup/stock_sale_invoice/' . $row['stock_sale_id']); ?>');" 
                        class="btn btn-default btn-sm">
                        <i class="fa fa-eye"></i> &nbsp;
                        <?php echo get_phrase('view_invoice');?>
                    </a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<script type="text/javascript">
    jQuery(window).load(function ()
    {
        var $ = jQuery;

        $("#table-2").dataTable({
            "sPaginationType": "bootstrap"
        });

        $(".dataTables_wrapper select").select2({
            minimumResultsForSearch: -1
        });
    });
</script>