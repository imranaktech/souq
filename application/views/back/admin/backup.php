<div id="content-container">
    <div id="page-title">
        <h1 class="page-header text-overflow"><?php echo translate('Backup');?></h1>
    </div>
    <div class="tab-base">
        <div class="panel">
            <div class="panel-body">
                <div class="tab-content">
                    <?php if($this->session->flashdata('success')) { ?>
                    <div class="alert alert-info">

                        <strong><?= $this->session->flashdata('success')?>!</strong> <?= $this->session->flashdata('backup_success_text')?>
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
                            <h3 class="panel-title"><?php echo translate('Get Backup of your script and data');?></h3>
                        </div>
						<?php
                            echo form_open(base_url() . 'admin/get_backup/', array(
                                'class' => 'form-horizontal',
                                'method' => 'post'
                            ));
                        ?>

                                <div class="panel-body">
                                    <ul>
                                        <li><strong>Instruction</strong></li>
                                    </ul>

                                    <ol>
                                        <li>
                                            <code>If you choose <strong>Download mode : root</strong> your script/sql/both will be stored in your project root folder.</code>
                                        </li>
                                        <li>
                                            <code>If you choose <strong>Download mode : download</strong> your script/sql/both will be zipped and downloading will be started</code>
                                        </li>
                                        <li>
                                            <code>Downloading full script may take longer<strong>(5- 10 minutes or more)</strong> than usual.</code>
                                        </li>
                                        <li>
                                            <code>Due to the limited execution time and memory available to PHP, backing up very large <strong>databases</strong> may not be possible. If your <strong>databases</strong> is very large you might need to backup directly from your SQL server via the command line, or have your server admin do it for you if you do not have root privileges.</code>
                                        </li>
                                        <li>
                                            <code>Due to the limited execution time and memory available to PHP, backing up very large <strong>project folder</strong> may not be possible. If your <strong>project folder</strong> is very large you might need to backup directly from cpanel or via ftp.</code>
                                        </li>
                                        <li>
                                            <code>If you choose to download, after downloading - <strong>click refresh</strong> to remove any residual file</code>
                                        </li>
                                    </ol>
                                </div>



                            <div class="panel-body">
                                <div class="form-group bord-top">
                                    <div class="col-sm-3">Backup mode</div>
                                    <div class="col-sm-6">
                                        <label class="radio-inline">
                                            <input type="radio" name="backup_mode" value="only_sql" checked>Only Sql
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="backup_mode" value="only_script">Only Script
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="backup_mode" value="both">Both
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group bord-top">
                                    <div class="col-sm-3">Download or Save in root folder</div>
                                    <div class="col-sm-6">
                                        <label class="radio-inline">
                                            <input type="radio" name="download_mode" value="download" checked>Download
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="download_mode" value="archive">Root
                                        </label>
                                    </div>
                                </div>

                            </div>
                            <div class="panel-footer text-right">
                                <button type="submit" class="btn btn-info submitter">
									<?php echo translate('Get Backup');?>
                                </button>
                                <button type="button" onclick="window.location.href = '<?= base_url()?>/admin/backup'" type="" class="btn btn-info submitter">
                                    <?php echo translate('Refresh');?>
                                </button>
                            </div>
                        <?php echo form_close() ?>
                    </div>
                </div>
            </div>
        <!--Panel body-->
        </div>
    </div>
</div>

<script type="text/javascript">

</script>


