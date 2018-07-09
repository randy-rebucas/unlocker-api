<div class="headerbar">
	
	<h1><?php echo lang('clients'); ?></h1>
	
	<div class="pull-right">
		<a class="btn btn-primary" href="<?php echo site_url('clients/form'); ?>"><i class="icon-plus icon-white"></i> <?php echo lang('new'); ?></a>
	</div>
	
	<div class="pull-right">
		<?php echo pager(site_url('clients/status/' . $this->uri->segment(3)), 'mdl_clients'); ?>
	</div>
	
	<div class="pull-right">
		<ul class="nav nav-pills index-options">
			<li <?php if ($this->uri->segment(3) == 'active' or !$this->uri->segment(3)) { ?>class="active"<?php } ?>><a href="<?php echo site_url('clients/status/active'); ?>"><?php echo lang('active'); ?></a></li>
			<li <?php if ($this->uri->segment(3) == 'inactive') { ?>class="active"<?php } ?>><a href="<?php echo site_url('clients/status/inactive'); ?>"><?php echo lang('inactive'); ?></a></li>
			<li <?php if ($this->uri->segment(3) == 'all') { ?>class="active"<?php } ?>><a href="<?php echo site_url('clients/status/all'); ?>"><?php echo lang('all'); ?></a></li>
		</ul>
	</div>
	
</div>

<div class="table-content">

	<?php $this->layout->load_view('layout/alerts'); ?>

	<div id="filter_results">
		<?php $this->layout->load_view('clients/partial_client_table'); ?>
	</div>

</div>