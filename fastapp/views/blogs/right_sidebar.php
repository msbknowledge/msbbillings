 <div class="col-lg-3 sidebar blog-sidebar">
            <div class="widget searh-widget">
            <form class="search-form" id="search-form" action="<?php echo base_url(); ?>home/index" method="get">
                <input type="text" name="search" id="search" placeholder="Search">
                   <button type="submit" class="btn btn-default btn-sm header-search-btn"><i class="fas fa-search"></i> Search </button>
 
              </form>
            </div>

            <div class="widget">
              <h5 class="widget-title">Categories</h5>
              <div class="widget-wrapper1">
                <ul class="catagory-list list-unstyled">
                  
                   <?php      
                  
                    foreach($catdetails as $row) 
                    {
                    ?>
                     <li><a class="d-flex align-items-center justify-content-between" href="<?php echo base_url('blogs?name='.$row['slug_hind'].'')?>"> <span class="text"><?php echo $row['categories_hindi'];?></span> <span class="count"><?php echo $row['categories_count'];?></span> </a></li>
                 
                    <?php } ?>
                 
                 
                </ul>
              </div>
            </div>



            <div class="widget">
              <h5 class="widget-title">Recent Blog</h5>
               <?php      
                    foreach($recentblogcont as $row) 
                    {
                        $id=$row->id;
                       $slug=$row->slug;
                    ?>
              <div class="widget-wrapper1">
                <div class="small-post-list">
                  <div class="post-item d-flex">
                      <div class="post-thumb"><a href="<?php echo base_url('blogs/blogdetails/'.$slug.'')?>"><img src="<?php echo base_url('uploads/blogs');?>/<?php echo $row->blog_images;?>" alt="">
                        </a> </div>
                          <div class="post-content"> <a class="title" href="<?php echo base_url('blogs/blogdetails/'.$slug.'')?>"><?php echo $row->blog_title;?></a>

                      <ul class="meta-post list-unstyled pl-0 d-flex">
                        <li> <span class="meta-content"><?php echo $row->publish_date;?></span> </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
               <?php } ?>
            </div>

            <div class="widget">
              <h5 class="widget-title">Tag Widgets</h5>
              <div class="widget-wrapper1">
               
                <ul class="tag-list list-unstyled">
                  <?php      
                    foreach($tags as $rows) 
                    {
                      ?>
                    <li><a href="<?php echo base_url('blogs/index?tags='.$rows->tags_hin.'')?>"><?php echo $rows->tags_hin;?></a></li>
                      <?php } ?>
                </ul>
              </div>
            </div>
          </div>
             
           </div> 
        </div>
  </section>

