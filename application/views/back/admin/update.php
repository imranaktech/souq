<div id="content-container">
    <div id="page-title">
        <h1 class="page-header text-overflow"><?php echo translate('Update');?></h1>
    </div>
    <div class="tab-base">
        <div class="panel">
            <div class="panel-body">
                <div class="tab-content">
                    <?php if($this->session->flashdata('success')) { ?>
                    <div class="alert alert-success">
                        <strong><?= $this->session->flashdata('success')?>!</strong>
                        <?= $this->session->flashdata('upload_success') ? $this->session->flashdata('upload_success') : ""?>
                        <?= $this->session->flashdata('update_success') ? $this->session->flashdata('update_success') : ""?>
                        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                    </div>
                    <?php } ?>
                    <?php if($this->session->flashdata('error')) { ?>
                        <div class="alert alert-danger">

                            <strong><?= $this->session->flashdata('error')?>!</strong> <?= $this->session->flashdata('error_text')?>
                            <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                        </div>
                    <?php } ?>
                    <div class="tab-pane fade active in" id="" style="border:1px solid #ebebeb; border-radius:4px;">
                        <div class="panel-heading">
                            <h3 class="panel-title"><?php echo translate('Update your script, Current version is');?>
                                <strong>
                                    <?php echo $this->db->get_where('general_settings',array('type'=>'version'))->row()->value; ?>
                                </strong>
                            </h3>
                        </div>


                        <div class="panel-body">
                            <ul>
                                <li><strong>Instruction</strong></li>
                            </ul>

                            <ol>
                                <li>
                                    <code>Must get full back up of your script and sql before starting the update process</code>
                                </li>
                                <li>
                                    <code>You can only update to next version from the immediate previous version.Read the given <strong>document with update.zip</strong> carefully on how to update</code>
                                </li>
                                <li>
                                    <code>You require proper <strong>folder permission</strong> for files to upload,extract and overwrite.Other wise take the manual approach</code>
                                </li>
                                <li>
                                    <code>Upload the <strong>update.zip</strong> file</code>
                                </li>
                                <li>
                                    <code>Uploading full script may take some time depending on the size of <strong>updates.zip</strong></code>
                                </li>
                                <li>
                                    <code>Once it is uploaded it will show update is available,then click to update</code>
                                </li>
                                <li>
                                    <code>It may take few minutes to extracting and replacing files and import the update sql</code>
                                </li>
                                <li>
                                    <code>Update may get interrupted or cause error, on that case update manually</code>
                                </li>
                                <li>
                                    <code>After the update you will see the new version</code>
                                </li>
                            </ol>
                        </div>

                        <?php if($update_available) { ?>
                        <div class="alert alert-info text-center">
                            <strong>Update is available !</strong>
                            <p>
                                <a class="btn btn-large btn-warning" href="<?= base_url('admin/do_update')?>">Click to update</a>
                                <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                            </p>
                        </div>
                        <?php } ?>

                        <span class="<?= $update_available == true ? ' d-none ' : '' ?>" >
                            <?php
                            echo form_open(base_url() . 'admin/upload_update_zip/', array(
                                'class' => 'form-horizontal',
                                'method' => 'post',
                                'enctype' => 'multipart/form-data'
                            ));
                            ?>


                            <div class="panel-body bord-top">
                                <div class="form-group">
                                    <div class="col-sm-2">Upload the update file</div>
                                    <div class="col-sm-10">
                                        <label class="">
                                            <input type="file" name="update"/>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer text-right">
                                <button type="submit" class="btn btn-info submitter">
									<?php echo translate('Upload');?>
                                </button>
                            </div>
                        <?php echo form_close() ?>
                        </span>

                    </div>
                </div>
            </div>
        <!--Panel body-->
        </div>
    </div>
</div>

<script type="text/javascript">

</script>


