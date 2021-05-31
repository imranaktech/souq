<!-- PAGE -->
<section class="page-section image testimonials home-3-blog" style="background: url(<?php echo base_url(); ?>uploads/others/parralax_blog.jpg) center top no-repeat; background-attachment:fixed;display: none; background-size:cover;">
    <div class="container" style="margin-top:30px !important; margin-bottom:30px !important;">
        <h2 class="section-title section-title-2">
            <span>
             	<?php echo $this->db->get_where('ui_settings',array('ui_settings_id' => 19))->row()->value;?>
            </span>
        </h2>
        <div class="row">
                <?php
                    $limit =  4;
                    $this->db->limit($limit);
                    $this->db->order_by("blog_id", "desc");
                    $blogs=$this->db->get('blog')->result_array();
                    foreach($blogs as $row){
                ?>
                <div class="col-lg-3 col-sm-6">
                    <div class="blog-box">
                        <a href="<?php echo $this->crud_model->blog_link($row['blog_id']); ?>">
                            <img src="<?php echo $this->crud_model->file_view('blog',$row['blog_id'],'','','thumb','src','',''); ?>" class="img-responsive" alt="" style="height:180px;width: 100%"/>
                        </a>
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <div class="title">
                                    <a href="<?php echo $this->crud_model->blog_link($row['blog_id']); ?>">
                                        <?php echo $row['title']; ?>
                                    </a>
                                </div>
                                <div class="author">
                                    <?php echo $row['author']; ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <?php
                    }
                ?>
        </div>
    </div>
</section>
<!-- /PAGE -->
                