<div id="content-container">
    <div id="page-title">
        <h1 class="page-header text-overflow"></h1>
    </div>
    <div class="tab-base">
        <div class="panel">
            <div class="tab-base tab-stacked-left">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a data-toggle="tab" href="#demo-stk-lft-tab-1"><?php echo translate('general_settings'); ?></a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#demo-stk-lft-tab-5"><?php echo translate('smtp_settings'); ?></a>
                    </li>
                    <li>
                        <a data-toggle="tab"
                           href="#demo-stk-lft-tab-6"><?php echo translate('affiliation_settings'); ?></a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#demo-stk-lft-tab-2"><?php echo translate('social_links'); ?></a>
                    </li>
                    <li>
                        <a data-toggle="tab"
                           href="#demo-stk-lft-tab-3"><?php echo translate('terms_&_condition'); ?></a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#demo-stk-lft-tab-4"><?php echo translate('privacy_policy'); ?></a>
                    </li>
                </ul>

                <div class="tab-content bg_grey">
                    <!--UPLOAD : general settings ---------->
                    <div id="demo-stk-lft-tab-1" class="tab-pane fade active in">
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title"><?php echo translate('general_settings'); ?></h3>
                            </div>
                            <?php
                            echo form_open(base_url() . 'admin/general_settings/set/', array(
                                'class' => 'form-horizontal',
                                'method' => 'post',
                                'id' => 'gen_set',
                                'enctype' => 'multipart/form-data'
                            ));
                            ?>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo translate('system_name'); ?></label>
                                    <div class="col-sm-6">
                                        <input type="text" name="system_name"
                                               value="<?php echo $this->crud_model->get_type_name_by_id('general_settings', '1', 'value'); ?>"
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo translate('system_email'); ?></label>
                                    <div class="col-sm-6">
                                        <input type="text" name="system_email"
                                               value="<?php echo $this->crud_model->get_type_name_by_id('general_settings', '2', 'value'); ?>"
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo translate('system_title'); ?></label>
                                    <div class="col-sm-6">
                                        <input type="text" name="system_title"
                                               value="<?php echo $this->crud_model->get_type_name_by_id('general_settings', '3', 'value'); ?>"
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo translate('homepage_cache_time'); ?>
                                        (<?php echo translate('minutes'); ?>)</label>
                                    <div class="col-sm-4">
                                        <input type="number" min='0' step='.01' name="cache_time"
                                               value="<?php echo $this->crud_model->get_type_name_by_id('general_settings', '59', 'value'); ?>"
                                               class="form-control">
                                    </div>
                                    <div class="col-sm-2">
                                        <?php echo translate('minutes'); ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo translate('downloadable_product_folder_name'); ?></label>
                                    <div class="col-sm-6">
                                        <input type="text" name="file_folder"
                                               value="<?php echo $this->crud_model->get_type_name_by_id('general_settings', '60', 'value'); ?>"
                                               class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo translate('language'); ?></label>
                                    <div class="col-sm-6">
                                        <select name="language" class="demo-cs-multiselect">
                                            <?php
                                            $set_lang = $this->db->get_where('general_settings', array('type' => 'language'))->row()->value;
                                            $fields = $this->db->list_fields('language');
                                            foreach ($fields as $field) {
                                                if ($field !== 'word' && $field !== 'word_id') {
                                                    ?>
                                                    <option value="<?php echo $field; ?>" <?php if ($set_lang == $field) {
                                                        echo 'selected';
                                                    } ?> ><?php echo $this->db->get_where('language_list', array('db_field' => $field))->row()->name; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo translate('admin_notification_sound'); ?></label>
                                    <div class="col-sm-6">
                                        <input id="admin_noti_sound" class='sw4' data-set='set_admin_notification_sound'
                                               type="checkbox"
                                               <?php if ($this->crud_model->get_type_name_by_id('general_settings', '45', 'value') == 'ok'){ ?>checked<?php } ?> />
                                    </div>
                                </div>
                                <?php
                                $ad_volume = $this->crud_model->get_type_name_by_id('general_settings', '46', 'value');
                                ?>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">
                                        <?php echo translate('admin_notification_volume'); ?>
                                    </label>
                                    <div class="col-sm-4">
                                        <div class="range-def" data-start="<?php echo($ad_volume * 10); ?>" data-min="0"
                                             data-max="10"></div>
                                        <div>
                                            <strong><?php echo translate('Volume_:_'); ?></strong>
                                            <span class="range-def-val"><?php echo $ad_volume; ?></span> / 10
                                            <input type="hidden" value="<?php echo $ad_volume; ?>"
                                                   name="admin_notification_volume">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">
                                        <?php echo translate('homepage_notification_sound'); ?>
                                    </label>
                                    <div class="col-sm-6">
                                        <input id="home_noti_sound" class='sw4' data-set='set_home_notification_sound'
                                               type="checkbox"
                                               <?php if ($this->crud_model->get_type_name_by_id('general_settings', '49', 'value') == 'ok'){ ?>checked<?php } ?> />
                                    </div>
                                </div>

                                <?php
                                $hom_volume = $this->crud_model->get_type_name_by_id('general_settings', '50', 'value');
                                ?>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">
                                        <?php echo translate('homepage_notification_volume'); ?>
                                    </label>
                                    <div class="col-sm-4">
                                        <div class="range-def" data-start="<?php echo($hom_volume * 10); ?>"
                                             data-min="0" data-max="10"></div>
                                        <div>
                                            <strong><?php echo translate('Volume_:_'); ?></strong>
                                            <span class="range-def-val"><?php echo $hom_volume; ?></span> / 10
                                            <input type="hidden" value="<?php echo $hom_volume; ?>"
                                                   name="homepage_notification_volume">
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="nowslide">
                            </div>
                            <div class="panel-footer text-right">
                                    <span class="btn btn-success btn-labeled fa fa-check submitter enterer"
                                          type="submit" data-ing='<?php echo translate('saving'); ?>'
                                          data-msg='<?php echo translate('settings_updated!'); ?>'>
                                        <?php echo translate('save'); ?>
                                    </span>
                            </div>
                            </form>
                        </div>
                    </div>
                    <span id="genset"></span>

                    <!-- SMTP SETTINGS -->
                    <div id="demo-stk-lft-tab-5"
                         class="tab-pane fade <?php if ($tab_name == "smtp_settings") { ?>active in<?php } ?>">
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title"><?php echo translate('smtp_settings'); ?></h3>
                            </div>
                            <?php
                            echo form_open(base_url() . 'admin/smtp_settings/set/', array(
                                'class' => 'form-horizontal',
                                'method' => 'post',
                                'id' => '',
                                'enctype' => 'multipart/form-data'
                            ));
                            ?>
                            <div class="panel-body">
                                <!-- Smtp Host  -->
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">
                                        <?php echo translate('smtp_status'); ?>
                                    </label>
                                    <div class="col-sm-6">
                                        <input id="mail_status" class='sw4' data-set='mail_status' type="checkbox"
                                               <?php if ($this->crud_model->get_settings_value('general_settings', 'mail_status', 'value') == 'smtp'){ ?>checked<?php } ?> />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">
                                        <?php echo translate('smtp_host'); ?>
                                    </label>
                                    <div class="col-sm-6">
                                        <input type="text" name="smtp_host" class="form-control"
                                               value="<?php echo $this->crud_model->get_settings_value('general_settings', 'smtp_host', 'value'); ?>">
                                    </div>
                                </div>
                                <!-- Smtp Port  -->
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">
                                        <?php echo translate('smtp_port'); ?>
                                    </label>
                                    <div class="col-sm-6">
                                        <input type="text" name="smtp_port" class="form-control"
                                               value="<?php echo $this->crud_model->get_settings_value('general_settings', 'smtp_port', 'value'); ?>">
                                    </div>
                                </div>
                                <!-- Smtp User  -->
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">
                                        <?php echo translate('smtp_user'); ?>
                                    </label>
                                    <div class="col-sm-6">
                                        <input type="text" name="smtp_user" class="form-control"
                                               value="<?php echo $this->crud_model->get_settings_value('general_settings', 'smtp_user', 'value'); ?>">
                                    </div>
                                </div>
                                <!-- Smtp Password  -->
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">
                                        <?php echo translate('smtp_password'); ?>
                                    </label>
                                    <div class="col-sm-6">
                                        <input type="password" name="smtp_pass" class="form-control"
                                               value="<?php echo $this->crud_model->get_settings_value('general_settings', 'smtp_pass', 'value'); ?>">
                                    </div>
                                </div>
                            </div>
                            <!--SAVE---------->
                            <div class="panel-footer text-right">
                                    <span class="btn btn-success btn-labeled fa fa-check submitter enterer"
                                          data-ing='<?php echo translate('saving'); ?>'
                                          data-msg='<?php echo translate('settings_updated!'); ?>'>
                                        <?php echo translate('save'); ?>
                                    </span>
                            </div>
                            </form>
                        </div>
                    </div>
                    <!-- SMTP SETTINGS ENDS -->

                    <!-- Affiliation SETTINGS -->
                    <div id="demo-stk-lft-tab-6"
                         class="tab-pane fade <?php if ($tab_name == "affiliation_settings") { ?>active in<?php } ?>">
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title"><?php echo translate('smtp_settings'); ?></h3>
                            </div>
                            <?php
                            echo form_open(base_url() . 'admin/affiliation_settings/set/', array(
                                'class' => 'form-horizontal',
                                'method' => 'post',
                                'id' => '',
                                'enctype' => 'multipart/form-data'
                            ));
                            ?>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">
                                        <?php echo translate('affiliation_validity'); ?>
                                    </label>
                                    <div class="col-sm-3">
                                        <input type="number" step="1" min="1" name="affiliation_validity"
                                               class="form-control"
                                               placeholder="<?php echo translate('ex: 15'); ?>"
                                               value="<?php echo $this->crud_model->get_settings_value('general_settings', 'affiliation_validity', 'value'); ?>">
                                    </div>
                                    <div class="col-sm-3">
                                            <small><?php echo translate('After this many days the validation for affiliated code will expire'); ?></small>
                                            <small><?php echo translate('Default 30 days'); ?></small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">
                                        <?php echo translate('affiliation_point_to_currency_rate'); ?>
                                    </label>
                                    <div class="col-sm-3">
                                        <input type="number" step=".1" min="0" name="affiliation_point_to_currency_rate"
                                               class="form-control"
                                               placeholder="<?php echo translate('ex: 2.56'); ?>"
                                               value="<?php echo $this->crud_model->get_settings_value('general_settings', 'affiliation_point_to_currency_rate', 'value'); ?>">
                                    </div>
                                    <div class="col-sm-3">
                                            <small><?php echo translate('1 point = X mount of your currency '); ?></small>
                                            <small><?php echo translate('Putting 3.2 here means if you convert 10 affiliated points to wallet, you will get 10 x 3.2 = 32 of your currency'); ?></small>
                                            <small><?php echo translate('Default 1 A.P. = 1 Actual currency'); ?></small>
                                    </div>
                                </div>
                            </div>
                            <!--SAVE---------->
                            <div class="panel-footer text-right">
                                    <span class="btn btn-success btn-labeled fa fa-check submitter enterer"
                                          data-ing='<?php echo translate('saving'); ?>'
                                          data-msg='<?php echo translate('settings_updated!'); ?>'>
                                        <?php echo translate('save'); ?>
                                    </span>
                            </div>
                            </form>
                        </div>
                    </div>
                    <!-- Affiliation SETTINGS ENDS -->

                    <!--UPLOAD : SOCIAL LINKS---------->
                    <div id="demo-stk-lft-tab-2"
                         class="tab-pane fade <?php if ($tab_name == "social_links") { ?>active in<?php } ?>">
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title"><?php echo translate('social_links'); ?></h3>
                            </div>
                            <?php
                            echo form_open(base_url() . 'admin/social_links/set/', array(
                                'class' => 'form-horizontal',
                                'method' => 'post',
                                'id' => '',
                                'enctype' => 'multipart/form-data'
                            ));
                            ?>
                            <div class="panel-body">
                                <!--FACEBOOK---------->
                                <div class="form-group mar-btm">
                                    <label class="col-sm-3 control-label"></label>
                                    <div class="col-sm-6">
                                        <div class="input-group mar-btm">
                                                <span class="input-group-addon fb_font">
                                                    <i class="fa fa-facebook-square fa-lg"></i>
                                                </span>
                                            <input type="text" name="facebook"
                                                   value="<?php echo $this->crud_model->get_type_name_by_id('social_links', '1', 'value'); ?>"
                                                   id="demo-hor-inputemail" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <!--G+---------->
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"></label>
                                    <div class="col-sm-6">
                                        <div class="input-group mar-btm">
                                                <span class="input-group-addon g_font">
                                                    <i class="fa fa-google-plus-square fa-lg"></i>
                                                </span>
                                            <input type="text" name="google-plus"
                                                   value="<?php echo $this->crud_model->get_type_name_by_id('social_links', '2', 'value'); ?>"
                                                   id="demo-hor-inputemail" class="form-control">
                                        </div>

                                    </div>
                                </div>
                                <!--TWITTER---------->
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"></label>
                                    <div class="col-sm-6">
                                        <div class="input-group mar-btm">
                                                <span class="input-group-addon tw_font">
                                                    <i class="fa fa-twitter-square fa-lg"></i>
                                                </span>
                                            <input type="text" name="twitter"
                                                   value="<?php echo $this->crud_model->get_type_name_by_id('social_links', '3', 'value'); ?>"
                                                   id="demo-hor-inputemail" class="form-control">
                                        </div>

                                    </div>
                                </div>
                                <!--PINTEREST---------->
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"></label>
                                    <div class="col-sm-6">
                                        <div class="input-group mar-btm">
                                                <span class="input-group-addon pin_font">
                                                    <i class="fa fa-pinterest fa-lg"></i>
                                                </span>
                                            <input type="text" name="pinterest"
                                                   value="<?php echo $this->crud_model->get_type_name_by_id('social_links', '5', 'value'); ?>"
                                                   id="demo-hor-inputemail" class="form-control">
                                        </div>

                                    </div>
                                </div>
                                <!--SKYPE---------->
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"></label>
                                    <div class="col-sm-6">
                                        <div class="input-group mar-btm">
                                                <span class="input-group-addon skype_font">
                                                    <i class="fa fa-skype fa-lg"></i>
                                                </span>
                                            <input type="text" name="skype"
                                                   value="<?php echo $this->crud_model->get_type_name_by_id('social_links', '4', 'value'); ?>"
                                                   id="demo-hor-inputemail" class="form-control">
                                        </div>

                                    </div>
                                </div>
                                <!--YOUTUBE---------->
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"></label>
                                    <div class="col-sm-6">
                                        <div class="input-group mar-btm">
                                                <span class="input-group-addon youtube_font">
                                                    <i class="fa fa-youtube fa-lg"></i>
                                                </span>
                                            <input type="text" name="youtube"
                                                   value="<?php echo $this->crud_model->get_type_name_by_id('social_links', '6', 'value'); ?>"
                                                   id="demo-hor-inputemail" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--SAVE---------->
                            <div class="panel-footer text-right">
                                    <span class="btn btn-success btn-labeled fa fa-check submitter enterer"
                                          data-ing='<?php echo translate('saving'); ?>'
                                          data-msg='<?php echo translate('settings_updated!'); ?>'>
                                        <?php echo translate('save'); ?>
                                    </span>
                            </div>
                            </form>
                        </div>
                    </div>
                    <!--UPLOAD : terms and condition---------->
                    <div id="demo-stk-lft-tab-3" class="tab-pane fade">
                        <div class="panel">
                            <?php
                            $terms_conditions = $this->db->get_where('general_settings', array('type' => 'terms_conditions'))->row()->value;
                            ?>
                            <div class="panel-heading">
                                <h3 class="panel-title"><?php echo translate('terms_&_condition'); ?></h3>
                            </div>
                            <?php
                            echo form_open(base_url() . 'admin/general_settings/terms/', array(
                                'class' => 'form-horizontal',
                                'method' => 'post',
                                'id' => '',
                                'enctype' => 'multipart/form-data'
                            ));
                            ?>
                            <div class="panel-body">
                                <textarea class="summernotes" data-height='700'
                                          data-name='terms'><?php echo $terms_conditions; ?></textarea>
                                <!--===================================================-->
                                <!-- End Summernote -->
                            </div>
                            <div class="panel-footer text-right">
                                    <span class="btn btn-success btn-labeled fa fa-check submitter"
                                          data-ing='<?php echo translate('saving'); ?>'
                                          data-msg='<?php echo translate('settings_updated!'); ?>'>
                                        <?php echo translate('save'); ?>
                                    </span>
                            </div>
                            </form>
                        </div>
                    </div>
                    <!--UPLOAD : privecy policy---------->
                    <div id="demo-stk-lft-tab-4" class="tab-pane fade">
                        <div class="panel">
                            <?php
                            $privacy_policy = $this->db->get_where('general_settings', array('type' => 'privacy_policy'))->row()->value;
                            ?>
                            <div class="panel-heading">
                                <h3 class="panel-title"><?php echo translate('privacy_policy'); ?></h3>
                            </div>
                            <?php
                            echo form_open(base_url() . 'admin/general_settings/privacy_policy/', array(
                                'class' => 'form-horizontal',
                                'method' => 'post',
                                'id' => '',
                                'enctype' => 'multipart/form-data'
                            ));
                            ?>
                            <div class="panel-body">
                                <textarea class="summernotes" data-height='700'
                                          data-name='privacy_policy'><?php echo $privacy_policy; ?></textarea>
                                <!--===================================================-->
                                <!-- End Summernote -->
                            </div>
                            <div class="panel-footer text-right">
                                    <span class="btn btn-success btn-labeled fa fa-check submitter"
                                          data-ing='<?php echo translate('saving'); ?>'
                                          data-msg='<?php echo translate('settings_updated!'); ?>'>
                                        <?php echo translate('save'); ?>
                                    </span>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div style="display:none;" id="site"></div>
<!-- for logo settings -->
<script>
    function load_logos() {
        ajax_load('<?php echo base_url(); ?>admin/logo_settings/show_all', 'list', '');
    }

    $(document).ready(function () {
        $('.summernotes').each(function () {
            var now = $(this);
            var h = now.data('height');
            var n = now.data('name');
            now.closest('div').append('<input type="hidden" class="val" name="' + n + '">');
            now.summernote({
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['view', ['codeview', 'help']],
                ],
                height: h,
                onChange: function () {
                    now.closest('div').find('.val').val(now.code());
                }
            });
            now.closest('div').find('.val').val(now.code());
            now.focus();
        });
        load_logos();

    });
    $(document).ready(function () {
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#wrap').hide('fast');
                    $('#blah').attr('src', e.target.result);
                    $('#wrap').show('fast');
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imgInp").change(function () {
            readURL(this);
        });

        function readURL1(input1) {
            if (input1.files && input1.files[0]) {
                var reader1 = new FileReader();

                reader1.onload = function (e) {
                    $('#wrap').hide('fast');
                    $('#blah1').attr('src', e.target.result);
                    $('#wrap').show('fast');
                }

                reader1.readAsDataURL(input1.files[0]);
            }
        }

        $("#imgInp1").change(function () {
            readURL1(this);
        });
    });
    var base_url = '<?php echo base_url(); ?>'
    var user_type = 'admin';
    var module = 'logo_settings';
    var list_cont_func = 'show_all';
    var dlt_cont_func = 'delete_logo';

    $(document).ready(function () {
        $('.demo-chosen-select').chosen();
        $('.demo-cs-multiselect').chosen({width: '100%'});
    });

    $(".range-def").on('slide', function () {
        var vals = $("#nowslide").val();
        $(this).closest(".form-group").find(".range-def-val").html(vals);
        $(this).closest(".form-group").find("input").val(vals);
    });

    function sets(now) {
        $(".range-def").each(function () {
            var min = $(this).data('min');
            var max = $(this).data('max');
            var start = $(this).data('start');
            $(this).noUiSlider({
                start: Number(start),
                range: {
                    'min': Number(min),
                    'max': Number(max)
                }
            }, true);
            if (now == 'first') {
                $(this).noUiSlider({
                    start: 500,
                    connect: 'lower',
                    range: {
                        'min': 0,
                        'max': 10
                    }
                }, true).Link('lower').to($("#nowslide"));
                $(this).closest(".form-group").find(".range-def-val").html(start);
                $(this).closest(".form-group").find("input").val(start);
            } else if (now == 'later') {
                var than = $(this).closest(".form-group").find(".range-def-val").html();

                if (than !== 'undefined') {
                    $(this).noUiSlider({
                        start: than,
                        connect: 'lower',
                        range: {
                            'min': min,
                            'max': max
                        }
                    }, true).Link('lower').to($("#nowslide"));
                }
                $(this).closest(".form-group").find(".range-def-val").html(than);
                $(this).closest(".form-group").find("input").val(than);
            }
        });
    }

    $(document).ready(function () {
        sets('later');
        $("form").submit(function (e) {
            return false;
        });

    });

</script>
<script src="<?php echo base_url(); ?>template/back/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js">
</script>

<script>
    $('.delete-div-wrap .aad').on('click', function () {
        var id = $(this).closest('.delete-div-wrap').find('iframe').data('id');
    });
</script>

<style>
    .img-fixed {
        width: 100px;
    }

    .tr-bg {
        background-image: url(http://www.mikechambers.com/files/html5/canvas/exportWithBackgroundColor/images/transparent_graphic.png)
    }

    .cc-selector input {
        margin: 0;
        padding: 0;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
    }

    .cc-selector input:active + .drinkcard-cc {
        opacity: 1;
        border: 4px solid #169D4B;
    }

    .cc-selector input:checked + .drinkcard-cc {
        -webkit-filter: none;
        -moz-filter: none;
        filter: none;
        border: 4px solid black;
    }

    .drinkcard-cc {
        cursor: pointer;
        background-size: contain;
        background-repeat: no-repeat;
        display: inline-block;
        -webkit-transition: all 100ms ease-in;
        -moz-transition: all 100ms ease-in;
        transition: all 100ms ease-in;
        -webkit-filter: opacity(.5);
        -moz-filter: opacity(.5);
        filter: opacity(.5);
        transition: all .6s ease-in-out;
        border: 4px solid transparent;
        border-radius: 5px !important;
    }

    .drinkcard-cc:hover {
        -webkit-filter: opacity(1);
        -moz-filter: opacity(1);
        filter: opacity(1);
        transition: all .6s ease-in-out;
        border: 4px solid #8400C5;

    }
</style>

