<style>
.bootstrap-select > .selectpicker {
    -webkit-appearance: none;
    -webkit-box-shadow: none;
    box-shadow: none !important;
    height: 50px;
    border-radius: 4px;
    border: 1px solid #c5c5c5;
    background-color: #ffffff !important;
    color: #737475 !important;
}
.dropdown-menu {
    border-width: 1px !important;
}
.input-group-addon {
    padding: 6px 16px;
}
</style>
<div class="information-title">
    <?php echo translate('Product bulk upload');?>
</div>
<div class="details-wrap">
    <div class="row">
        <div class="col-md-12">
            <div class="tabs-wrapper content-tabs">
                <div class="tab-content">
                    <div class="tab-pane fade in active">
                    	<div class="details-wrap">
                            <div class="row">
                                <div class="col-12">
                                    <div style="margin: 4px">
                                        <h3>Instructions gg</h3>
                                        <ol>
                                            <li>
                                                Download the skeleton file and fill it with data.
                                            </li>
                                            <li>
                                                You can download the example file to understand how the data must be filled
                                            </li>
                                            <li>
                                                Once you have downloaded and filled the skeleton file , upload it in the form below and
                                                submit.
                                            </li>
                                            <li>
                                                <code>*Do not upload more than 50 products at a time . Add maximum 2 image URLs per
                                                    product.</code>
                                            </li>
                                            <li>
                                                Products should be uploaded successfully.
                                            </li>
                                        </ol>

                                        <br>

                                        <h3>More Instructions</h3>
                                        <ol>
                                            <li>
                                                Category and Sub category  should be in <code>numerical ids</code>.Click the <code>respected modals/pop-ups</code> to see the related ids
                                            </li>
                                            <li>
                                                Brand should be in <code>Plain text</code>.
                                            </li>
                                            <li>
                                                Condition should be in <code>new</code> or <code>used</code>.
                                            </li>
                                            <li>
                                                Tax and Discount can be in percentage.For example if the discount is 15, write only
                                                15.If the discount is 15 percent, write 15%.Do the same for tax.
                                            </li>
                                            <li>
                                                Tags are comma separated.If you have tags like "baby" and "food" write
                                                <code>baby,food</code>.
                                            </li>
                                            <li>
                                                Image Urls are comma separated.If you have many image urls write like this: <code>http://imagescource/image001.jpg,http://anotherimagescource/image005.jpg</code>
                                            </li>
                                            <li>To publish automatically, fill the "published" column with <code>yes</code></li>
                                            <li>
                                                Products should be uploaded successfully.
                                            </li>
                                        </ol>
                                    </div>
                                </div>
                                <?php if ($this->session->flashdata('success')) { ?>
                                    <div class="alert alert-success alert-dismissible show" role="alert">
                                        <?php echo $this->session->flashdata('success') ?>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <?php } ?>
                                <?php if ($this->session->flashdata('error')) { ?>
                                    <div class="alert alert-danger alert-dismissible show" role="alert">
                                        <?php echo $this->session->flashdata('error') ?>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <?php } ?>
                                <?php if ($upload_amount <= 0){ ?>
                                    <p class="text-center text-danger"><?=translate('your_remaining_product_upload_amount:_').'<b>0</b><br>'.translate('please_purchase_a_package_to_upload_more_products.')?></p>
                                    <div class="text-center">
                                        <a href="<?=base_url()?>home/premium_package" class="btn btn-theme"><?=translate('purchase_package')?></a>
                                    </div>
                                <?php }  ?>

                                <?php if ($upload_amount > 0){ ?>
                                    <p class="text-center text-danger"><?=translate('your_remaining_product_upload_amount:_')?><b><?php echo $upload_amount ?></b><br></p>
                                    <p class="text-center text-danger"><?=translate("Only this number of products will be uploaded from the xlsx file")?></p>
                                    <div class="col-12">

                                    <div style="margin: 4px;border: 1px solid;padding: 2px">
                                        <h3><?php echo translate("Physical product") ?></h3>
                                        <br>
                                        <div class="" style="padding: 4px">
                                            <a class="btn btn-sm btn-success" target="_blank" download
                                               href="<?php echo base_url() . "uploads/bulk_skeletons/customer_product.xlsx" ?>"><?php echo translate('Download product bulk upload skeleton file'); ?></a>
                                            <a class="btn btn-sm btn-primary" target="_blank" download
                                               href="<?php echo base_url() . "uploads/bulk_skeletons/customer_product_example.xlsx" ?>"><?php echo translate('Download product bulk upload example file'); ?></a>
                                        </div>
                                        <div class="" style="padding: 4px">
                                            <button data-target="#product_category" type="button" class="btn btn-primary"
                                                    data-toggle="modal"><?php echo translate("Category") ?></button>
                                            <button data-target="#product_sub_category" type="button" class="btn btn-primary"
                                                    data-toggle="modal"><?php echo translate("Sub Category") ?></button>

                                            <div id="product_category" class="modal fade bd-example-modal-lg" tabindex="-1"
                                                 role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id=""></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body" style="overflow:scroll; height:400px;">
                                                            <?php if(!empty($physical_categories)){ ?>
                                                                <table class="table table-bordered table-responsive dataTable">
                                                                    <tr>
                                                                        <th><?php echo translate('Id')?></th>
                                                                        <th><?php echo translate('Name')?></th>
                                                                    </tr>
                                                                    <?php foreach($physical_categories as $physical_category){ ?>
                                                                        <tr>
                                                                            <td><?php echo $physical_category['category_id']?></td>
                                                                            <td><?php echo $physical_category['category_name']?></td>
                                                                        </tr>
                                                                    <?php } ?>
                                                                </table>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="product_sub_category" class="modal fade bd-example-modal-lg" tabindex="-1"
                                                 role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id=""></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body" style="overflow:scroll; height:400px;">
                                                            <?php if(!empty($physical_sub_categories)){ ?>
                                                                <table class="table table-bordered table-responsive dataTable">
                                                                    <tr>
                                                                        <th><?php echo translate('Id')?></th>
                                                                        <th><?php echo translate('Name')?></th>
                                                                        <th><?php echo translate('Category Id')?></th>
                                                                    </tr>
                                                                    <?php foreach($physical_sub_categories as $physical_sub_category){ ?>
                                                                        <tr>
                                                                            <td><?php echo $physical_sub_category['sub_category_id']?></td>
                                                                            <td><?php echo $physical_sub_category['sub_category_name']?></td>
                                                                            <td><?php echo $physical_sub_category['category']?></td>
                                                                        </tr>
                                                                    <?php } ?>
                                                                </table>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="product_brand" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
                                                 aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id=""></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body" style="overflow:scroll; height:400px;">
                                                            <?php if(!empty($brands)){ ?>
                                                                <table class="table table-bordered table-responsive dataTable">
                                                                    <tr>
                                                                        <th><?php echo translate('Id')?></th>
                                                                        <th><?php echo translate('Name')?></th>
                                                                    </tr>
                                                                    <?php foreach($brands as $brand){ ?>
                                                                        <tr>
                                                                            <td><?php echo $brand['brand_id']?></td>
                                                                            <td><?php echo $brand['name']?></td>
                                                                        </tr>
                                                                    <?php } ?>
                                                                </table>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <?php
                                        echo form_open(base_url() . 'home/customer_product_bulk_upload_save', array(
                                            'class' => 'form',
                                            'method' => 'post',
                                            'id' => '',
                                            'enctype' => 'multipart/form-data'
                                        ));
                                        ?>
                                        <div class="form-group">
                                            <label for="bulk_file"><?php echo translate("Upload File") ?></label>
                                            <input type="file" class="form-control" name="bulk_file">
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-primary" type="submit"><?php echo translate("Submit") ?></button>
                                        </div>
                                        <?php echo form_close() ?>
                                    </div>

                                </div>
                                <div class="col-12" style="display: none">
                                    <div style="margin: 4px;border: 1px solid;padding: 2px">
                                        <h3><?php echo translate("Digital product") ?></h3>
                                        <br>
                                        <div class="" style="padding: 4px">
                                            <a class="btn btn-sm btn-success" target="_blank" download
                                               href="<?php echo base_url() . "uploads/bulk_skeletons/digital_product.xlsx" ?>"><?php echo translate('Download digital product bulk upload skeleton file'); ?></a>
                                            <a class="btn btn-sm btn-primary" target="_blank" download
                                               href="<?php echo base_url() . "uploads/bulk_skeletons/digital_product_example.xlsx" ?>"><?php echo translate('Download digital produc _bulk upload example file'); ?></a>
                                        </div>
                                        <div class="" style="padding: 4px">
                                            <button data-target="#digital_product_category" type="button" class="btn btn-primary"
                                                    data-toggle="modal" ><?php echo translate("Category") ?></button>
                                            <button data-target="#digital_product_sub_category" type="button" class="btn btn-primary"
                                                    data-toggle="modal" ><?php echo translate("Sub Category") ?></button>

                                            <div id="digital_product_category" class="modal fade bd-example-modal-lg" tabindex="-1"
                                                 role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id=""></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body" style="overflow:scroll; height:400px;">
                                                            <?php if(!empty($digital_categories)){ ?>
                                                                <table class="table table-bordered table-responsive dataTable">
                                                                    <tr>
                                                                        <th><?php echo translate('Id')?></th>
                                                                        <th><?php echo translate('Name')?></th>
                                                                    </tr>
                                                                    <?php foreach($digital_categories as $digital_category){ ?>
                                                                        <tr>
                                                                            <td><?php echo $digital_category['category_id']?></td>
                                                                            <td><?php echo $digital_category['category_name']?></td>
                                                                        </tr>
                                                                    <?php } ?>
                                                                </table>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="digital_product_sub_category" class="modal fade bd-example-modal-lg" tabindex="-1"
                                                 role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id=""></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body" style="overflow:scroll; height:400px;">
                                                            <?php if(!empty($digital_sub_categories)){ ?>
                                                                <table class="table table-bordered table-responsive dataTable">
                                                                    <tr>
                                                                        <th><?php echo translate('Id')?></th>
                                                                        <th><?php echo translate('Name')?></th>
                                                                        <th><?php echo translate('Category Id')?></th>
                                                                    </tr>
                                                                    <?php foreach($digital_sub_categories as $digital_sub_category){ ?>
                                                                        <tr>
                                                                            <td><?php echo $digital_sub_category['sub_category_id']?></td>
                                                                            <td><?php echo $digital_sub_category['sub_category_name']?></td>
                                                                            <td><?php echo $digital_sub_category['category']?></td>
                                                                        </tr>
                                                                    <?php } ?>
                                                                </table>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <?php
                                        echo form_open(base_url() . 'home/customer_digital_product_bulk_upload_save', array(
                                            'class' => 'form',
                                            'method' => 'post',
                                            'id' => '',
                                            'enctype' => 'multipart/form-data'
                                        ));
                                        ?>
                                        <div class="form-group">
                                            <label for="bulk_file"><?php echo translate("Upload File") ?></label>
                                            <input type="file" class="form-control" name="bulk_file">
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-primary" type="submit"><?php echo translate("Submit") ?></button>
                                        </div>
                                        <?php echo form_close() ?>
                                    </div>

                                </div>
                                <?php }  ?>

                            </div>

                        </div>   
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
