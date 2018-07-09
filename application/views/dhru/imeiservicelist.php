<table class="table table-striped table-bordered table-hover" id="sample_3">
	<thead>
		<tr>
			<th class="table-checkbox">
				<input type="checkbox" class="group-checkable" data-set="#sample_3 .checkboxes"/>
			</th>
			<th>
				 Services name
			</th>
			<th>
				 Description
			</th>
			<th>
				 Status
			</th>
			<th class="text-center">
				 Actions
			</th>
		</tr>
	</thead>
	<tbody>
		<?php 

		echo '<pre>';
		print_r($result['SUCCESS']['RESULT']['LIST'] );

		?>
		 <div class="accordian">
                             
            <div>                    
                <h4 id="g0">
                    <span>
                        <?php //echo $this->Category->get_info($row->category_id)->category_name;?>                           
                    </span>
                </h4>
		
			</div>        
      
            <div style="clear:both"></div>
        </div>
         
	</tbody>
</table>	

				