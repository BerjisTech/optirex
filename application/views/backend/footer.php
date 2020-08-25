<?php $version = $this->db->get_where('settings', array('type' => 'version'))->row()->description;?>
<!-- Footer -->
<footer class="main">
	&copy; <?php echo date("Y"); ?> <strong>Optirex Eye Care HMS</strong>
    <strong class="pull-right"> VERSION <?php echo $version;?></strong>
    Developed by
	<a href="https://www.google.com/search?q=berjis+technologies"
    	target="_blank">Berjis Technologies</a>
</footer>
