
<div id="content-container">
    <div id="page-title">
        <h1 class="page-header text-overflow"><?php echo translate('Product bulk upload'); ?></h1>
    </div>

    <div class="tab-base">
        <div class="panel">
            <div class="panel-body">
                <div class="tab-content" style="border:1px solid #ebebeb; border-radius:4px;">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="tabs-wrapper content-tabs">
                                <div class="tab-content">
                                    <div class="tab-pane fade in active" >
                                        <div class="details-wrap">
                                            <div class="panel">
                                                <div class="panel-heading">
                                                    <h3>Instructions</h3>
                                                </div>
                                                <div class="panel-body">
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

                                                    <div>
                                                        <a class="btn btn-sm btn-primary btn-dark" target="_blank" download
                                                           href="<?php echo base_url() . "uploads/bulk_skeletons/product.xlsx" ?>"><?php echo translate('Download product bulk upload skeleton file'); ?></a>
                                                        <a class="btn btn-sm btn-primary" target="_blank" download
                                                           href="<?php echo base_url() . "uploads/bulk_skeletons/product_example.xlsx" ?>"><?php echo translate('Download product bulk upload example file'); ?></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel">
                                                <div class="panel-heading">
                                                    <h3>More Instructions</h3>
                                                </div>
                                                <div class="panel-body">
                                                    <ol>
                                                        <li>
                                                            Category,Sub category and Brand should be in <code>numerical ids</code>.Click the <code>respected modals/pop-ups</code> to see the related ids
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

                                                    <div>

                                                        <button data-target="#product_category" type="button" class="btn btn-primary"
                                                                data-toggle="modal"><?php echo translate("Category ID List") ?></button>
                                                        <button data-target="#product_sub_category" type="button" class="btn btn-primary"
                                                                data-toggle="modal"><?php echo translate("Sub Category ID List") ?></button>
                                                        <button data-target="#product_brand" type="button" class="btn btn-primary"
                                                                data-toggle="modal"><?php echo translate("Brand ID List") ?></button>

                                                        <div id="product_category" class="modal fade bd-example-modal-lg" tabindex="-1"
                                                             role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                        <h5 class="modal-title" id=""><?php echo translate('Category IDs')?></h5>
                                                                    </div>
                                                                    <div class="modal-body" style="overflow:scroll; max-height:400px;">
                                                                        <?php if(!empty($physical_categories)){ ?>
                                                                            <table class="table table-bordered table-responsive dataTable">
                                                                                <tr>
                                                                                    <th><?php echo translate('Category ID')?></th>
                                                                                    <th><?php echo translate('Category Name')?></th>
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
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                        <h5 class="modal-title" id=""><?php echo translate('Sub Category IDs with Category ID')?></h5>
                                                                    </div>
                                                                    <div class="modal-body" style="overflow:scroll; max-height:400px;">
                                                                        <?php if(!empty($physical_sub_categories)){ ?>
                                                                            <table class="table table-bordered table-responsive dataTable">
                                                                                <tr>
                                                                                    <th><?php echo translate('Sub Category ID')?></th>
                                                                                    <th><?php echo translate('Sub Category Name')?></th>
                                                                                    <th><?php echo translate('Category ID')?></th>
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
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                        <h5 class="modal-title" id=""><?php echo translate('Brand IDs')?></h5>

                                                                    </div>
                                                                    <div class="modal-body" style="overflow:scroll; max-height:400px;">
                                                                        <?php if(!empty($brands)){ ?>
                                                                            <table class="table table-bordered table-responsive dataTable">
                                                                                <tr>
                                                                                    <th><?php echo translate('Brand ID')?></th>
                                                                                    <th><?php echo translate('Brand Name')?></th>
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
                                                </div>
                                            </div>
                                            <div class="panel mb-0">
                                                <div class="panel-heading">
                                                    <h3><?php echo translate("Upload your products") ?></h3>
                                                </div>
                                                <div class="panel-body">
                                                    <?php
                                                    echo form_open(base_url() . 'admin/product_bulk_upload_save', array(
                                                        'class' => 'form',
                                                        'method' => 'post',
                                                        'id' => '',
                                                        'enctype' => 'multipart/form-data'
                                                    ));
                                                    ?>
                                                    <div class="form-group">
                                                <span class="btn btn-default btn-file">
                                                    <?php echo translate("Choose File") ?>
                                                    <input type="file" class="form-control" name="bulk_file">
                                                </span>
                                                    </div>
                                                    <div class="form-group">
                                                        <button class="btn btn-mint btn-labeled fa fa-upload" type="submit"><?php echo translate("Upload Products") ?></button>
                                                    </div>
                                                    <?php echo form_close() ?>


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

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
<script>
    var base_url = '<?php echo base_url(); ?>';
    var timer = '<?php $this->benchmark->mark_time(); ?>';
    var user_type = 'admin';
    var module = 'product_bulk_upload';
    var list_cont_func = '';
    var dlt_cont_func = '';

    document.addEventListener('DOMContentLoaded',function(e){

    })

</script>