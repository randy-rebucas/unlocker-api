<div class="tab-info">

	<div class="control-group">
		<label class="control-label"><?php echo lang('default_pdf_template'); ?>: </label>
		<div class="controls">
			<select name="settings[pdf_quote_template]">
				<option value=""></option>
				<?php foreach ($pdf_quote_templates as $quote_template) { ?>
				<option value="<?php echo $quote_template; ?>" <?php if ($this->Mdl_settings->setting('pdf_quote_template') == $quote_template) { ?>selected="selected"<?php } ?>><?php echo $quote_template; ?></option>
				<?php } ?>
			</select>
		</div>
	</div>
    
	<div class="control-group">
		<label class="control-label"><?php echo lang('default_public_template'); ?>: </label>
		<div class="controls">
			<select name="settings[public_quote_template]">
				<option value=""></option>
				<?php foreach ($public_quote_templates as $quote_template) { ?>
				<option value="<?php echo $quote_template; ?>" <?php if ($this->Mdl_settings->setting('public_quote_template') == $quote_template) { ?>selected="selected"<?php } ?>><?php echo $quote_template; ?></option>
				<?php } ?>
			</select>
		</div>
	</div>
    
	<div class="control-group">
		<label class="control-label"><?php echo lang('default_email_template'); ?>: </label>
		<div class="controls">
			<select name="settings[email_quote_template]">
                <option value=""></option>
                <?php foreach ($email_templates as $email_template) { ?>
                <option value="<?php echo $email_template->email_template_id; ?>" <?php if ($this->Mdl_settings->setting('email_quote_template') == $email_template->email_template_id) { ?>selected="selected"<?php } ?>><?php echo $email_template->email_template_title; ?></option>
                <?php } ?>
			</select>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo lang('quotes_expire_after'); ?>: </label>
		<div class="controls">
			<input type="text" name="settings[quotes_expire_after]" class="input-small" value="<?php echo $this->Mdl_settings->setting('quotes_expire_after'); ?>">
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"><?php echo lang('default_quote_group'); ?>: </label>
		<div class="controls">
			<select name="settings[default_quote_group]">
				<option value=""></option>
				<?php foreach ($invoice_groups as $invoice_group) { ?>
				<option value="<?php echo $invoice_group->invoice_group_id; ?>" <?php if ($this->Mdl_settings->setting('default_quote_group') == $invoice_group->invoice_group_id) { ?>selected="selected"<?php } ?>><?php echo $invoice_group->invoice_group_name; ?></option>
				<?php } ?>
			</select>
		</div>
	</div>
    
	<div class="control-group">
		<label class="control-label"><?php echo lang('mark_quotes_sent_pdf'); ?>: </label>
		<div class="controls">
			<select name="settings[mark_quotes_sent_pdf]">
                <option value="0" <?php if (!$this->Mdl_settings->setting('mark_quotes_sent_pdf')) { ?>selected="selected"<?php } ?>><?php echo lang('no'); ?></option>
                <option value="1" <?php if ($this->Mdl_settings->setting('mark_quotes_sent_pdf')) { ?>selected="selected"<?php } ?>><?php echo lang('yes'); ?></option>
			</select>
		</div>
	</div>

</div>