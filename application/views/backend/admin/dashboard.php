<div class="row">
    <div class="col-sm-4">
        <a href="<?php echo site_url('admin/doctor'); ?>">
            <div class="tile-stats tile-white tile-white-primary">
                <div class="icon"><i class="fa fa-user-md"></i></div>
                <div class="num" data-start="0" data-end="<?php echo $this->db->count_all('doctor'); ?>"
                    data-duration="1500" data-delay="0"><?php echo $this->db->count_all('doctor'); ?></div>
                <h3><?php echo get_phrase('doctor') ?></h3>
            </div>
        </a>
    </div>

    <div class="col-sm-4">
        <a href="<?php echo site_url('admin/patient'); ?>">
            <div class="tile-stats tile-white-red">
                <div class="icon"><i class="fa fa-user"></i></div>
                <div class="num" data-start="0" data-end="<?php echo $this->db->count_all('patient'); ?>"
                    data-duration="1500" data-delay="0"><?php echo $this->db->count_all('patient'); ?></div>
                <h3><?php echo get_phrase('patient') ?></h3>
            </div>
        </a>
    </div>

    <div class="col-sm-3 hidden">
        <a href="<?php echo site_url('admin/nurse'); ?>">
            <div class="tile-stats tile-white-aqua">
                <div class="icon"><i class="fa fa-plus-square"></i></div>
                <div class="num" data-start="0" data-end="<?php echo $this->db->count_all('nurse'); ?>"
                    data-duration="1500" data-delay="0"><?php echo $this->db->count_all('nurse'); ?></div>
                <h3><?php echo get_phrase('nurse') ?></h3>
            </div>
        </a>
    </div>

    <div class="col-sm-4">
        <a href="<?php echo site_url('admin/pharmacist'); ?>">
            <div class="tile-stats tile-white-blue">
                <div class="icon"><i class="fa fa-medkit"></i></div>
                <div class="num" data-start="0" data-end="<?php echo $this->db->count_all('pharmacist'); ?>"
                    data-duration="1500" data-delay="0"><?php echo $this->db->count_all('pharmacist'); ?></div>
                <h3><?php echo get_phrase('store_keeper') ?></h3>
            </div>
        </a>
    </div>
</div>

<br />

<div class="row">
    <div class="col-sm-3 hidden">
        <a href="<?php echo site_url('admin/laboratorist'); ?>">
            <div class="tile-stats tile-white-cyan">
                <div class="icon"><i class="fa fa-user"></i></div>
                <div class="num" data-start="0" data-end="<?php echo $this->db->count_all('laboratorist'); ?>"
                    data-duration="1500" data-delay="0"><?php echo $this->db->count_all('laboratorist'); ?></div>
                <h3><?php echo get_phrase('laboratorist') ?></h3>
            </div>
        </a>
    </div>

    <div class="col-sm-4">
        <a href="<?php echo site_url('admin/accountant'); ?>">
            <div class="tile-stats tile-white-purple">
                <div class="icon"><i class="fa fa-money"></i></div>
                <div class="num" data-start="0" data-end="<?php echo $this->db->count_all('accountant'); ?>"
                    data-duration="1500" data-delay="0"><?php echo $this->db->count_all('accountant'); ?></div>
                <h3><?php echo get_phrase('accountant') ?></h3>
            </div>
        </a>
    </div>

    <div class="col-sm-4">
        <a href="<?php echo site_url('admin/payment_history'); ?>">
            <div class="tile-stats tile-white-pink">
                <div class="icon"><i class="fa fa-list-alt"></i></div>
                <div class="num" data-start="0" data-end="<?php echo $this->db->count_all('invoice'); ?>"
                    data-duration="1500" data-delay="0"><?php echo $this->db->count_all('invoice'); ?></div>
                <h3><?php echo get_phrase('payment') ?></h3>
            </div>
        </a>
    </div>

    <div class="col-sm-4">
        <a href="<?php echo site_url('admin/medicine'); ?>">
            <div class="tile-stats tile-white-orange">
                <div class="icon"><i class="fa fa-medkit"></i></div>
                <div class="num" data-start="0" data-end="<?php echo $this->db->count_all('medicine'); ?>"
                    data-duration="1500" data-delay="0"><?php echo $this->db->count_all('medicine'); ?></div>
                <h3><?php echo get_phrase('medicine') ?></h3>
            </div>
        </a>
    </div>
</div>

<br />

<div class="row hidden">
    <div class="col-sm-3">
        <a href="<?php echo site_url('admin/operation_report'); ?>">
            <div class="tile-stats tile-white-green">
                <div class="icon"><i class="fa fa-wheelchair"></i></div>
                <div class="num" data-start="0"
                    data-end="<?php echo count($this->db->get_where('report', array('type' => 'operation'))->result_array());?>"
                    data-duration="1500" data-delay="0"></div>
                <h3><?php echo get_phrase('operation_report') ?></h3>
            </div>
        </a>
    </div>

    <div class="col-sm-3">
        <a href="<?php echo site_url('admin/birth_report'); ?>">
            <div class="tile-stats tile-white-brown">
                <div class="icon"><i class="fa fa-github-alt"></i></div>
                <div class="num" data-start="0"
                    data-end="<?php echo count($this->db->get_where('report', array('type' => 'birth'))->result_array());?>"
                    data-duration="1500" data-delay="0"></div>
                <h3><?php echo get_phrase('birth_report') ?></h3>
            </div>
        </a>
    </div>

    <div class="col-sm-3">
        <a href="<?php echo site_url('admin/death_report'); ?>">
            <div class="tile-stats tile-white-plum">
                <div class="icon"><i class="fa fa-ban"></i></div>
                <div class="num" data-start="0"
                    data-end="<?php echo count($this->db->get_where('report', array('type' => 'death'))->result_array());?>"
                    data-duration="1500" data-delay="0"></div>
                <h3><?php echo get_phrase('death_report') ?></h3>
            </div>
        </a>
    </div>

</div>
<script type="text/javascript">
jQuery(document).ready(function($) {
    // Sparkline Charts
    $('.pageviews').sparkline('html', {
        type: 'bar',
        height: '30px',
        barColor: '#ff6264'
    });
    $('.uniquevisitors').sparkline('html', {
        type: 'bar',
        height: '30px',
        barColor: '#00b19d'
    });
    $('.inlinebar').sparkline('html', {
        type: 'bar',
        barColor: '#ff6264'
    });
    $(".monthly-admissions").sparkline([<?php
		foreach($this->db->select('*, count(patient_id) as registrations, date_format(from_unixtime(account_opening_timestamp), "%Y %m %d") as year, date_format(from_unixtime(account_opening_timestamp), "%m") as month')->where('account_opening_timestamp >=', strtotime(date('d-m-y', time())))->group_by('month')->order_by('year', 'asc')->get('patient')->result_array() as $fetch){
			echo ','.$fetch['registrations'];
		}
	?>], {
        type: 'bar',
        barColor: '#485671',
        height: '80px',
        barWidth: 10,
        barSpacing: 2
    });
    $(".admissions").sparkline([<?php
		foreach($this->db->select('*, count(patient_id) as registrations, date_format(from_unixtime(account_opening_timestamp), "%Y %m %d") as year, date_format(from_unixtime(account_opening_timestamp), "%m") as month')->where('account_opening_timestamp >=', strtotime(date('d-m-y', time())))->group_by('month')->order_by('year', 'asc')->get('patient')->result_array() as $fetch){
			echo ','.$fetch['registrations'];
		}
	?>], {
		type: 'line',
		width: '100%',
		height: '55',
		lineColor: '#e8b51b',
		fillColor: '',
		lineWidth: 2,
		spotColor: '#344e86',
		minSpotColor: '#344e86',
		maxSpotColor: '#344e86',
		highlightSpotColor: '#344e86',
		highlightLineColor: '#30487b',
		spotRadius: 2,
		drawNormalOnTop: true
	});

    $(".medicine-sales").sparkline([<?php
		foreach($this->db->select('*, sum(amount) as sales, date_format(from_unixtime(timestamp), "%Y %m %d") as year, date_format(from_unixtime(timestamp), "%m") as month')->where('timestamp >=', strtotime(date('d-m-y', time())))->group_by('month')->order_by('year', 'asc')->get('payment')->result_array() as $fetch){
			echo ','.$fetch['sales'];
		}
	?>], {
        type: 'line',
        width: '100%',
        height: '55',
        lineColor: '#ff4e50',
        fillColor: '#ffd2d3',
        lineWidth: 2,
        spotColor: '#a9282a',
        minSpotColor: '#a9282a',
        maxSpotColor: '#a9282a',
        highlightSpotColor: '#a9282a',
        highlightLineColor: '#f4c3c4',
        spotRadius: 2,
        drawNormalOnTop: true
    });

    $(".pie-chart").sparkline([<?php echo $this->db->select('count(patient_id) as loan')->get('patient')->row()->loan; ?>, 
								<?php echo $this->db->select('count(stock_id) as deposit')->get('stock')->row()->deposit; ?>, 
								<?php echo $this->db->select('count(medicine_id) as shares')->get('medicine')->row()->shares; ?>], {
        type: 'pie',
        width: '95',
        height: '95',
        sliceColors: ['#ff4e50', '#db3739', '#a9282a']
    });

    $(".stock-sales").sparkline([<?php
		foreach($this->db->select('*, sum(amount) as sales, date_format(from_unixtime(timestamp), "%Y %m %d") as year, date_format(from_unixtime(timestamp), "%m") as month')->where('timestamp >=', strtotime(date('d-m-y', time())))->group_by('month')->order_by('year', 'asc')->get('payment')->result_array() as $fetch){
			echo ','.$fetch['sales'];
		}
	?>], {
        type: 'line',
        width: '100%',
        height: '55',
        lineColor: '#ff4e50',
        fillColor: '',
        lineWidth: 2,
        spotColor: '#a9282a',
        minSpotColor: '#a9282a',
        maxSpotColor: '#a9282a',
        highlightSpotColor: '#a9282a',
        highlightLineColor: '#f4c3c4',
        spotRadius: 2,
        drawNormalOnTop: true
    });

    // Line Charts
    var line_chart_demo = $("#line-chart-demo");
    var line_chart = Morris.Line({
        element: 'line-chart-demo',
        data: [{
                y: '2006',
                a: 100,
                b: 90
            },
            {
                y: '2007',
                a: 75,
                b: 65
            },
            {
                y: '2008',
                a: 50,
                b: 40
            },
            {
                y: '2009',
                a: 75,
                b: 65
            },
            {
                y: '2010',
                a: 50,
                b: 40
            },
            {
                y: '2011',
                a: 75,
                b: 65
            },
            {
                y: '2012',
                a: 100,
                b: 90
            }
        ],
        xkey: 'y',
        ykeys: ['a', 'b'],
        labels: ['Proccured', 'Sales'],
        lineColors: ['#ec3b83', '#00acd6'],
        redraw: true
    });
    line_chart_demo.parent().attr('style', '');

    // Donut Chart
    var donut_chart_demo = $("#donut-chart-demo");
    donut_chart_demo.parent().show();
    var donut_chart = Morris.Donut({
        element: 'donut-chart-demo',
        data: [{
                label: "Patients",
                value: <?php echo $this->db->select('count(patient_id) as loan')->get('patient')->row()->loan; ?>
            },
            {
                label: "Stock",
                value: <?php echo $this->db->select('count(stock_id) as deposit')->get('stock')->row()->deposit; ?>
            },
            {
                label: "Medicine",
                value: <?php echo $this->db->select('count(medicine_id) as shares')->get('medicine')->row()->shares; ?>
            }
        ],
        colors: ['#FF4E50', '#DB3739', '#A9282A']
    });
    donut_chart_demo.parent().attr('style', '');

    // Area Chart
    var area_chart_demo = $("#area-chart-demo");
    area_chart_demo.parent().show();
    var area_chart = Morris.Area({
        element: 'area-chart-demo',
        data: [{
                y: '2006',
                a: 100,
                b: 90
            },
            {
                y: '2007',
                a: 75,
                b: 65
            },
            {
                y: '2008',
                a: 50,
                b: 40
            },
            {
                y: '2009',
                a: 75,
                b: 65
            },
            {
                y: '2010',
                a: 50,
                b: 40
            },
            {
                y: '2011',
                a: 75,
                b: 65
            },
            {
                y: '2012',
                a: 100,
                b: 90
            }
        ],
        xkey: 'y',
        ykeys: ['a', 'b'],
        labels: ['Proccured', 'Sales'],
        lineColors: ['#00acd6', '#ec3b83']
    });
    area_chart_demo.parent().attr('style', '');
});

function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}
</script>
<div class="row">
    <div class="col-md-3 col-sm-6">
        <div class="tile-stats tile-white stat-tile" style="box-shadow: 0 0 20px rgba(0,0,0,0.11);">
            <h3><?php echo number_format($this->db->get('patient')->num_rows()); ?> patient</h3>
            <p><?php echo $this->db->select('count(patient_id) as patient')->where('date_format(from_unixtime(account_opening_timestamp), "%m %Y") =', date('m Y'))->get('patient')->row()->patient; ?>
                more admitted this month</p> <span class="admissions"></span>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="tile-stats tile-white stat-tile" style="box-shadow: 0 0 20px rgba(0,0,0,0.11);">
            <h3><?php echo number_format($this->db->get('patient')->num_rows()); ?></h3>
            <p>Total Medicine Sales</p> <span class="medicine-sales"></span>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="tile-stats tile-white stat-tile" style="box-shadow: 0 0 20px rgba(0,0,0,0.11);">
            <h3><?php echo number_format($this->db->get('patient')->num_rows()); ?></h3>
            <p>Total Stock Sales</p> <span class="stock-sales"></span>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="tile-stats tile-white stat-tile" style="box-shadow: 0 0 20px rgba(0,0,0,0.11);">
            <p>
                <?php 
					$stocks = $this->db->select('count(stock_id) as deposit')->get('stock')->row()->deposit;
					$medicine = $this->db->select('count(medicine_id) as shares')->get('medicine')->row()->shares;
					$patients = $this->db->select('count(patient_id) as loan')->get('patient')->row()->loan;
					$total = $stocks + $medicine + $patients;
				?>
                <span style="color: #ec3b83;">Patients
                    <?php echo number_format((float)($patients*100)/$total, 1, '.', ''); ?>%</span> <br />
                <span style="color: #00acd6;">Stock
                    <?php echo number_format((float)($stocks*100)/$total, 1, '.', ''); ?>%</span> <br />
                <span style="color: #e8b51b;">Medicine
                    <?php echo number_format((float)($medicine*100)/$total, 1, '.', ''); ?>%</span>
            </p> <span class="pie-chart"></span>
        </div>
    </div>
</div> <br />
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-primary" id="charts_env">
            <div class="panel-heading">
                <div class="panel-title" style="display: inline-table; color: #373e4a;">Statistics</div>
                <div class="panel-options" style="display: inline-table; float: right; text-align: right;">
                    <ul class="nav nav-tabs">
                        <li class=""><a href="#area-chart" data-toggle="tab">Medicine</a></li>
                        <li class="active"><a href="#line-chart" data-toggle="tab">Stocks</a></li>
                        <li class=""><a href="#pie-chart" data-toggle="tab">Comparison Chart</a></li>
                    </ul>
                </div>
            </div>
            <div class="panel-body">
                <div class="tab-content">
                    <div class="tab-pane" id="area-chart">
                        <div id="area-chart-demo" class="morrischart" style="height: 300px"></div>
                    </div>
                    <div class="tab-pane active" id="line-chart">
                        <div id="line-chart-demo" class="morrischart" style="height: 300px"></div>
                    </div>
                    <div class="tab-pane" id="pie-chart">
                        <div id="donut-chart-demo" class="morrischart" style="height: 300px;"></div>
                    </div>
                </div>
            </div>
            <table class="table table-bordered table-responsive" style="background: #949494;">
                <thead>
                    <tr>
                        <th width="50%" class="col-padding-1">
                            <div class="pull-left">
                                <div class="h4 no-margin">Total Procurement<br /> <small>(Medicine + Other
                                        Stocks)</small></div> <small>54,127</small>
                            </div>
                            <span class="pull-right pageviews">2,3,5,4,3,4,5</span>
                        </th>
                        <th width="50%" class="col-padding-1">
                            <div class="pull-left">
                                <div class="h4 no-margin">Total Sales<br /> <small>(Medicine + Other Stocks)</small>
                                </div> <small>25,127</small>
                            </div>
                            <span class="pull-right uniquevisitors">4,3,5,4,5,6,5</span>
                        </th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div> <br />
<div class="row">
    <div class="col-sm-4">
        <div class="panel panel-primary">
            <table class="table table-bordered table-responsive">
                <thead>
                    <tr>
                        <th class="padding-bottom-none text-center"> <br /> <br /> <span class="monthly-admissions"></span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="panel-heading">
                            <h4>Monthly admisions</h4>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="panel-title" style="display: inline-table; color: #373e4a;">Latest Updated Profiles</div>
                <div class="panel-options" style="display: inline-table; float: right;"> <a href="#sample-modal"
                        data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i
                            class="entypo-cog"></i></a> <a href="#" data-rel="collapse"><i
                            class="entypo-down-open"></i></a> <a href="#" data-rel="reload"><i
                            class="entypo-arrows-ccw"></i></a> <a href="#" data-rel="close"><i
                            class="entypo-cancel"></i></a> </div>
            </div>
            <table class="table table-bordered table-responsive">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Activity</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($this->db->order_by('patient_id', 'DESC')->limit('3')->get('patient')->result_array() as $fetch): ?>
                    <tr>
                        <td><?php echo $fetch['patient_id'] ?></td>
                        <td><?php echo $fetch['name'] ?></td>
                        <td class="text-center"><span class="inlinebar">
                                <?php
										foreach($this->db->select('count(patient_id) as patient, date_format(from_unixtime(account_opening_timestamp), "%m") as month, date_format(from_unixtime(account_opening_timestamp), "%Y %m %d") as year')->where('patient_id', $fetch['patient_id'])->group_by('month')->order_by('year', 'asc')->get('patient')->result_array() as $fetch){
											echo $fetch['patient'].',';
										}
									?>
                            </span></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div> <br />

<script src="<?php echo base_url(); ?>assets/js/jquery.sparkline.min.js" id="script-resource-10"></script>
<script src="<?php echo base_url(); ?>assets/js/morris.min.js" id="script-resource-14"></script>
<script src="<?php echo base_url(); ?>assets/js/raphael-min.js" id="script-resource-13"></script>