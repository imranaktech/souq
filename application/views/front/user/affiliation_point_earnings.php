<div class="information-title">
    <?php echo translate('affiliation_point_earnings'); ?>
</div>
<?php if (empty($affiliation_point_earning_total)) { ?>
    <p><?php echo translate('You have no earnings from product affiliation'); ?></p>
<?php } ?>
<?php if (!empty($affiliation_point_earning_total)) { ?>
    <p><?php echo translate('total earned points'); ?> :
        <strong><?php echo $affiliation_point_earning_total['points'] ?></strong>
    </p>
    <p><?php echo translate('money converted to currency'); ?> :
        <strong><?php echo currency($affiliation_point_earning_total['currency']) ?></strong></p>
<?php } ?>
<div class="wishlist">
    <table class="table" style="background: #fff;">
        <thead>
        <tr>
            <th>#</th>
            <th><?php echo translate('code'); ?></th>
            <th><?php echo translate('current_affiliation_link'); ?></th>
            <th><?php echo translate('product'); ?></th>
            <th><?php echo translate('affiliation_user'); ?></th>
            <th><?php echo translate('points'); ?></th>
            <th><?php echo translate('currency '); ?></th>
            <th><?php echo translate('time'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($affiliation_point_earnings)) {
            $i = 0; ?>
            <?php foreach ($affiliation_point_earnings as $affiliation_point_earning) { $i++; $affiliation_link_text = 'affiliation_link_text_'.$i?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $affiliation_point_earning['code'] ?></td>
                    <td style="min-width: 25em">
                        <input readonly type="text" class="form-control" id="<?= $affiliation_link_text ?>"
                               placeholder="Click to get shareable link" value="<?php echo $this->crud_model->get_affiliation_link($affiliation_point_earning['product_id'], $this->session->userdata('user_id')) ?>" aria-label="" aria-describedby="">
                        <button class="btn btn-active-purple btn-block form_btn mt-2" type="button"
                                onclick="copyText('<?= $affiliation_link_text ?>',this,event,'<?= translate('copied') ?>')">
                            <?= translate("copy") ?>
                        </button>
                    </td>
                    <td class="image">
                        <a class="media-link" href="<?php echo $this->crud_model->product_link($affiliation_point_earning['product_id']); ?>">
                            <i class="fa fa-plus"></i>
                            <img width="100" src="<?php echo $this->crud_model->file_view('product',$affiliation_point_earning['product_id'],'','','thumb','src','multi','one'); ?>" alt=""/>
                        </a>
                    </td>
                    <td>
                        <?php
                        $affiliation_user = $this->db->get_where('user',array('user_id' => $affiliation_point_earning['affiliation_user_id'] ))->row_array();
                        $affiliation_user_detail = "";
                        if(!empty($affiliation_user)){
                            $affiliation_user_detail = ucfirst($affiliation_user['username'])." ".ucfirst($affiliation_user['surname'])." ({$affiliation_user['email']})";
                        }
                        echo "<small>$affiliation_user_detail</small>";
                        ?>
                    </td>
                    <td><?php echo $affiliation_point_earning['points'] ?></td>
                    <td><?php echo currency($affiliation_point_earning['currency']) ?></td>
                    <td><?php echo date("F jS, Y  h:i a", strtotime($affiliation_point_earning['used_at']))?></td>
                </tr>
            <?php } ?>
        <?php } ?>
        </tbody>
    </table>
</div>


</div>

<script>

    $(document).ready(function () {

    });

</script>