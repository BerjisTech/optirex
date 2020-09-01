<div class="container">
	<div id="row">
		<div id="col-6">
			<h5>Payment Details</h5>
			<table class='table table-hover table-border table-striped'>
			<?php if($status == 'successful'){?>
				<tr class='success bg-success text-light'>
					<th>Payment Status</th>
					<td ><?=$status?></td>
				</tr>
				<tr>
					<th>Transaction ID [Reference No#]</th>
					<td><?=$txn_id;?></td>
				</tr>
				<tr>
					<th>Amount</th>
					<td><?=$amount.''.$currency_code;?></td>
				</tr>
				<tr>
					<th>Customer Email Address</th>
					<td><?=$customer_email;?></td>
				</tr>
				<tr>
					<th>Message</th>
					<td><?=$message;?></td>
				</tr>
				<tr>
					<th>Payment Plan</th>
					<td><?=$payment_plan;?></td>
				</tr>
			<?php }elseif($status == 'cancelled' || $status == 'error' ){?>
				<tr class='danger bg-danger text-white'>
					<th>Payment Status</th>
					<td><?=$status?></td>
				</tr>
				<tr>
					<th>Message</th>
					<td><?=$message?></td>
				</tr>
				
			<?php }?>
            </table>
            
            <?php if($status == 'successful'){?>
                <a class='btn btn-success' href='<?=base_url('admin/payment_history')?>'>Done</a>
            <?php }elseif($status == 'cancelled' || $status == 'error' ){?>
                <a class='btn btn-danger' href='<?=base_url('payments/pay/'.$invoice_id.'/'.$amount)?>'>Retry</a>
            <?php }?>
		</div>
		<div class='col-12 '>
			<hr>
			<h4>Full Response Data Returned >> </h4>
			<hr>
			<pre><?php print_r($full_data);?></pre>
		</div>
	</div>
<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>

