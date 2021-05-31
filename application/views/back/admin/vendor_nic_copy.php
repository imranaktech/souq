<?php 
	foreach($vendor_data as $row)
	{ 
	    //echo "<pre>";print_r($row);exit();
?>
    <div id="content-container" style="padding-top:0px !important;">
        <div class="text-center pad-all">
            
               
                <img class="img-sm img-border" style="  height: 300px;
  width: 60%;"
                    src="<?php echo base_url().$row['nic_copy']; ?>" /> 
  
            
        </div>
    
    				
    </div>					
<?php 
	}
?>
            
<style>
.custom_td{
border-left: 1px solid #ddd;
border-right: 1px solid #ddd;
border-bottom: 1px solid #ddd;
}
</style>
<script type="text/javascript">
    $(document).ready(function(){
        $('.enterer').hide();
    });
</script>