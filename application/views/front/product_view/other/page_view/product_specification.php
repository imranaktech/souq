<?php
    $discus_id = $this->db->get_where('general_settings',array('type'=>'discus_id'))->row()->value;
    $fb_id = $this->db->get_where('general_settings',array('type'=>'fb_comment_api'))->row()->value;
    $comment_type = $this->db->get_where('general_settings',array('type'=>'comment_type'))->row()->value;
?>
<style>
    .review-comment{
        margin: 1em;
        padding: 1em;
    }
</style>
<!-- PAGE -->
<section class="page-section specification">
    <div class="container">
        <div class="tabs-wrapper content-tabs">
            <ul class="nav nav-tabs">
                <li  class="active"  ><a href="#tab1" data-toggle="tab"><?php echo translate('full_description'); ?></a></li>
                <li ><a href="#tab2" data-toggle="tab"><?php echo translate('additional_specification'); ?></a></li>
                <li ><a href="#tab3" data-toggle="tab"><?php echo translate('shipment_info'); ?></a></li>
                <li ><a href="#tab4" data-toggle="tab"><?php echo translate('reviews'); ?></a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade in active" id="tab1" itemprop="description">
                    <?php echo $row['description'];?>
                </div>
                <div class="tab-pane fade" id="tab2">
                    <div class="panel panel-sea margin-bottom-40">
                    <?php 
                        $a = $this->crud_model->get_additional_fields($row['product_id']);
                        if(count($a)>0){
                    ?>
                        <table class="table table-bordered">
                            <tbody>
                            <?php
                                foreach ($a as $val) {
                            ?>
                                <tr>
                                    <td style="text-align:center;"><?php echo $val['name']; ?></td>
                                    <td style="text-align:center;"><?php echo $val['value']; ?></td>
                                </tr>
                            <?php
                                }
                            ?>
                            </tbody>
                        </table>
                    <?php 
                        }
                    ?>
                    </div>
                </div>
                <div class="tab-pane fade" id="tab3">
                    <?php
                        echo $this->db->get_where('business_settings',array('type'=>'shipment_info'))->row()->value;
                    ?>
                </div>
                <div class="tab-pane fade" id="tab4">
                    <?php

                    $rating_form  = empty($user_given_rating) ? true : false;
                    $user_logged_in =  $this->session->userdata('user_login') == "yes" ? true : false;
                    ?>

                    <h3><?= translate('My Rating')?></h3>
                    <span <?php if($user_logged_in) { ?> style="display: none" <?php } ?> >
                            <p><?= translate('Log in to add/edit rating')?></p>
                    </span>
                    <span <?php if($user_bought_product) { ?> style="display: none" <?php } ?> >
                            <p><?= translate('You have to buy the product to give a review')?></p>
                    </span>

                    <div <?php if(!($user_logged_in && $user_bought_product)) { ?> style="display: none" <?php } ?>>

                        <span id="my_rating_span" <?php if($rating_form) { ?> style="display: none" <?php } ?>>
                            <b>Me </b> <div id="given_rating_star" class="rateit" data-rateit-value="<?= isset($user_given_rating['rating'])? $user_given_rating['rating']: 0?>" data-rateit-ispreset="true" data-rateit-readonly="true"></div>

                            <div class="review-comment" id="given_rating_comment" <?php if(!(isset($user_given_rating['comment']) && !empty($user_given_rating['comment']))) { ?> style="display: none" <?php } ?> >
                                 <?= isset($user_given_rating['comment'])? $user_given_rating['comment']: ""?>
                             </div>
                            <div class="form-group">
                                <button id="edit_my_rating" class="btn btn-primary"><?= translate('Edit')?></button>
                            </div>
                        </span>

                        <span id="my_rating_edit_span" <?php if(!$rating_form) { ?> style="display: none" <?php } ?>>
                            <input type="hidden" id="rating_editable" value="">
                            <input type="hidden" id="backing_rateit_product_by_user">
                            <input id="set_product_rating" name="set_product_rating" type="hidden"
                                   value="<?= isset($user_given_rating['rating']) ? $user_given_rating['rating'] : 0 ?>">
                            <input id="set_product_id" name="set_product_id" type="hidden"
                                   value="<?= $row['product_id'] ?>">
                            <input id="set_product_type" name="set_product_type" type="hidden"
                                   value="product">
                            <div id="rateit_product_by_user"
                                 data-rateit-resetable="false"
                                 data-rateit-ispreset="true"
                                 data-rateit-value="<?= isset($user_given_rating['rating']) ? $user_given_rating['rating'] : 0 ?>"
                            >
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="set_product_rating_comment"
                                          id="set_product_rating_comment"><?= isset($user_given_rating['comment']) ? $user_given_rating['comment'] : "" ?></textarea>
                            </div>
                            <div class="form-group">
                                <button id="submit_my_rating" class="btn btn-primary"><?= translate('Submit')?></button>
                            </div>
                        </span>

                    </div>

                    <div class="panel">
                        <div class="panel-head">
                            <h3><?= translate('All Ratings')?></h3>
                        </div>
                        <hr>
                        <div class="panel-body">
                            <div class="row">
                                <?php if (!empty($user_ratings)) { ?>
                                    <?php foreach ($user_ratings as $ur) { ?>
                                        <?php if ($ur['user_id'] != $this->session->userdata('user_id')) { ?>
                                            <span itemprop="review" itemscope itemtype="http://schema.org/Review">
                                                <b itemprop="author"><?= $ur['username']?></b>
                                                <span itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
                                                    <div itemprop="ratingValue"  class="rateit" data-rateit-value="<?=$ur['rating']?>" data-rateit-ispreset="true" data-rateit-readonly="true"></div>
                                                </span>
                                                <?php if (!empty($ur['comment'])) { ?>
                                                    <div class="review-comment" itemprop="name">
                                                        <?= $ur['comment']?>
                                                    </div>
                                                <?php } ?>
                                                <hr>
                                            </span>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>
                                <?php if (empty($user_ratings)) { ?>
                                    <?= translate('No ratings yet')?>
                                <?php } ?>
                            </div>
                        </div>
                    </div>


					<?php if($comment_type == 'disqus'){ ?>
                    <div id="disqus_thread"></div>
                    <script type="text/javascript">
                        /* * * CONFIGURATION VARIABLES * * */
                        var disqus_shortname = '<?php echo $discus_id; ?>';
                        
                        /* * * DON'T EDIT BELOW THIS LINE * * */
                        (function() {
                            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
                            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
                        })();
                    </script>
                    <script type="text/javascript">
                        /* * * CONFIGURATION VARIABLES * * */
                            var disqus_shortname = '<?php echo $discus_id; ?>';
                        
                        /* * * DON'T EDIT BELOW THIS LINE * * */
                        (function () {
                            var s = document.createElement('script'); s.async = true;
                            s.type = 'text/javascript';
                            s.src = '//' + disqus_shortname + '.disqus.com/count.js';
                            (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
                        }());
                    </script>
                    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>
                    <?php
                        }
                        else if($comment_type == 'facebook'){
                    ?>

                        <div id="fb-root"></div>
                        <script>(function(d, s, id) {
                          var js, fjs = d.getElementsByTagName(s)[0];
                          if (d.getElementById(id)) return;
                          js = d.createElement(s); js.id = id;
                          js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4&appId=<?php echo $fb_id; ?>";
                          fjs.parentNode.insertBefore(js, fjs);
                        }(document, 'script', 'facebook-jssdk'));</script>
                        <div class="fb-comments" data-href="<?php echo $this->crud_model->product_link($row['product_id']); ?>" data-numposts="5"></div>

                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /PAGE -->
<style>
@media(max-width: 768px) {
	.specification .nav-tabs>li{
		float: none;
		display: block;
		text-align: center;
	}
}
</style>


<script type="text/javascript">
    $(function () {
        var rateit_product_by_user =  $("#rateit_product_by_user");
        var edit_my_rating =  $("#edit_my_rating");
        var submit_my_rating =  $("#submit_my_rating");
        var my_rating_span =  $("#my_rating_span");
        var my_rating_edit_span =  $("#my_rating_edit_span");

        var set_product_rating =  $("#set_product_rating");
        var set_product_rating_comment =  $("#set_product_rating_comment");
        var set_product_id =  $("#set_product_id");
        var set_product_type =  $("#set_product_type");

        var given_rating_star =  $("#given_rating_star");
        var given_rating_comment =  $("#given_rating_comment");

        rateit_product_by_user.rateit(
            { max: 5, min:0, step: 0.5, backingfld: '#backing_rateit_product_by_user' }
        );
        rateit_product_by_user.bind('rated', function (event, value) {
            set_product_rating.val(value);
        });
        rateit_product_by_user.bind('reset', function () {
            set_product_rating.val(1);
        });
        rateit_product_by_user.bind('over', function (event, value) {
        });

        edit_my_rating.on('click',function (e) {
            my_rating_span.hide();
            my_rating_edit_span.show();
        });

        submit_my_rating.on('click',function (e) {
            var rating = set_product_rating.val();
            var comment = set_product_rating_comment.val();
            var product_id = set_product_id.val();
            var product_type = set_product_type.val();

            ajaxRequest = $.ajax({
                url: "<?= base_url()?>home/ajax_post_user_rating",
                type: "post",
                data:
                    {
                        "rating":rating,
                        "comment":comment,
                        "product_id":product_id,
                        "product_type":product_type,
                    }
            });

            /*  request cab be abort by ajaxRequest.abort() */

            ajaxRequest.done(function (response, textStatus, jqXHR){
                // show successfully for submit message

                given_rating_star.rateit('value', rating);

                given_rating_comment.html(comment);
                if(comment != "" && comment != null){
                    given_rating_comment.show();
                }else{
                    given_rating_comment.hide();
                }

                my_rating_span.show();
                my_rating_edit_span.hide();
            });

            /* On failure of request this function will be called  */
            ajaxRequest.fail(function (){
                alert("error");
                my_rating_span.show();
                my_rating_edit_span.hide();
            });
        });
    })
</script>