<style type="text/css">
  * {
    box-sizing: border-box;
}
body {
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
    line-height: 1.4;
    color: rgba(0, 0, 0, 0.85);
    background-color: #f9f9f9;

}
button {
    -moz-appearance: none;
    -webkit-appearance: none;
    appearance: none;
    font-size: 14px;
    padding: 4px 8px;
    color: rgba(0, 0, 0, 0.85);
    background-color: #fff;
    border: 1px solid rgba(0, 0, 0, 0.2);
    border-radius: 4px;
}
button:hover,
button:focus,
button:active {
    cursor: pointer;
    background-color: #ecf0f1;
}
.comment-thread {
    width: 700px;
    max-width: 100%;
    margin: auto;
    padding: 0 30px;
    background-color: #fff;
    border: 1px solid transparent; /* Removes margin collapse */
}
.m-0 {
    margin: 0;
}
.sr-only {
    position: absolute;
    left: -10000px;
    top: auto;
    width: 1px;
    height: 1px;
    overflow: hidden;
}

/* Comment */

.comment {
    position: relative;
    margin: 20px auto;
}
.comment-heading {
    display: flex;
    align-items: center;
    height: 50px;
    font-size: 14px;
}
.comment-voting {
    width: 20px;
    height: 32px;
    border: 1px solid rgba(0, 0, 0, 0.2);
    border-radius: 4px;
}
.comment-voting button {
    display: block;
    width: 100%;
    height: 50%;
    padding: 0;
    border: 0;
    font-size: 10px;
}
.comment-info {
    color: rgba(0, 0, 0, 0.5);
    margin-left: 10px;
}
.comment-author {
    color: rgba(0, 0, 0, 0.85);
    font-weight: bold;
    text-decoration: none;
}
.comment-author:hover {
    text-decoration: underline;
}
.replies {
    margin-left: 20px;
}

/* Adjustments for the comment border links */

.comment-border-link {
    display: block;
    position: absolute;
    top: 50px;
    left: 0;
    width: 12px;
    height: calc(100% - 50px);
    border-left: 4px solid transparent;
    border-right: 4px solid transparent;
    background-color: rgba(0, 0, 0, 0.1);
    background-clip: padding-box;
}
.comment-border-link:hover {
    background-color: rgba(0, 0, 0, 0.3);
}
.comment-body {
    padding: 0 20px;
    padding-left: 28px;
}
.replies {
    margin-left: 28px;
}

/* Adjustments for toggleable comments */

details.comment summary {
    position: relative;
    list-style: none;
    cursor: pointer;
}
details.comment summary::-webkit-details-marker {
    display: none;
}
details.comment:not([open]) .comment-heading {
    border-bottom: 1px solid rgba(0, 0, 0, 0.2);
}
.comment-heading::after {
    display: inline-block;
    position: absolute;
    right: 5px;
    align-self: center;
    font-size: 12px;
    color: rgba(0, 0, 0, 0.55);
}
details.comment[open] .comment-heading::after {
    content: "Click to hide";
}
details.comment:not([open]) .comment-heading::after {
    content: "Click to show";
}

/* Adjustment for Internet Explorer */

@media screen and (-ms-high-contrast: active), (-ms-high-contrast: none) {
    /* Resets cursor, and removes prompt text on Internet Explorer */
    .comment-heading {
        cursor: default;
    }
    details.comment[open] .comment-heading::after,
    details.comment:not([open]) .comment-heading::after {
        content: " ";
    }
}

/* Styling the reply to comment form */

.reply-form textarea {
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
    font-size: 16px;
    width: 100%;
    max-width: 100%;
    margin-top: 15px;
    margin-bottom: 5px;
}
.d-none {
    display: none;
}

  /* 
    Body, button, comment-thread, and utilities

    Notes:
        - This section sets some basic styles. You can ignore this part and 
        go directly to the comment styles.
*/


</style>


<div class="page-layout">
  <div class="catagory-sidebar-area">
    <div class="catagory-sidebar-area-inner">
      <div class="catagory-sidebar all-catagory-option">
        <ul class="catagory-submenu">
          <li><a data-toggle="collapse" href="#catagory-widget1" role="button" aria-expanded="false" aria-controls="catagory-widget1">Vegetables<i class="fas fa-angle-down"></i></a>
            <ul class="catagory-submenu collapse show" id="catagory-widget1">
              <li><a href="product-list.html">Artichoke.</a></li>
              <li><a href="product-list.html">Aubergine (eggplant).</a></li>
              <li><a href="product-list.html">Asparagus.</a></li>
              <li><a href="product-list.html">Broccoflower (a hybrid).</a></li>
              <li><a href="product-list.html">Broccoli (calabrese).</a></li>
            </ul>
          </li>
          <li><a  data-toggle="collapse" href="#catagory-widget2" role="button" aria-expanded="false" aria-controls="catagory-widget2">Fruits<i class="fas fa-angle-down"></i></a>
            <ul class="catagory-submenu collapse" id="catagory-widget2">
              <li><a href="product-list.html">Artichoke.</a></li>
              <li><a href="product-list.html">Aubergine (eggplant).</a></li>
              <li><a href="product-list.html">Asparagus.</a></li>
              <li><a href="product-list.html">Broccoflower (a hybrid).</a></li>
              <li><a href="product-list.html">Broccoli (calabrese).</a></li>
            </ul>
          </li>
          <li><a  data-toggle="collapse" href="#catagory-widget3" role="button" aria-expanded="false" aria-controls="catagory-widget3">Salads<i class="fas fa-angle-down"></i></a>
            <ul class="catagory-submenu collapse" id="catagory-widget3">
              <li><a href="product-list.html">Artichoke.</a></li>
              <li><a href="product-list.html">Aubergine (eggplant).</a></li>
              <li><a href="product-list.html">Asparagus.</a></li>
              <li><a href="product-list.html">Broccoflower (a hybrid).</a></li>
              <li><a href="product-list.html">Broccoli (calabrese).</a></li>
            </ul>
          </li>
          <li><a  data-toggle="collapse" href="#catagory-widget4" role="button" aria-expanded="false" aria-controls="catagory-widget4">Fish & seafood<i class="fas fa-angle-down"></i></a>
            <ul class="catagory-submenu collapse" id="catagory-widget4">
              <li><a href="product-list.html">Artichoke.</a></li>
              <li><a href="product-list.html">Aubergine (eggplant).</a></li>
              <li><a href="product-list.html">Asparagus.</a></li>
              <li><a href="product-list.html">Broccoflower (a hybrid).</a></li>
              <li><a href="product-list.html">Broccoli (calabrese).</a></li>
            </ul>
          </li>
          <li><a  data-toggle="collapse" href="#catagory-widget5" role="button" aria-expanded="false" aria-controls="catagory-widget5">Fresh Meat<i class="fas fa-angle-down"></i></a>
            <ul class="catagory-submenu collapse" id="catagory-widget5">
              <li><a href="product-list.html">Artichoke.</a></li>
              <li><a href="product-list.html">Aubergine (eggplant).</a></li>
              <li><a href="product-list.html">Asparagus.</a></li>
              <li><a href="product-list.html">Broccoflower (a hybrid).</a></li>
              <li><a href="product-list.html">Broccoli (calabrese).</a></li>
            </ul>
          </li>
          <li><a  data-toggle="collapse" href="#catagory-widget6" role="button" aria-expanded="false" aria-controls="catagory-widget6">Health Products<i class="fas fa-angle-down"></i></a>
            <ul class="catagory-submenu collapse" id="catagory-widget6">
              <li><a href="product-list.html">Artichoke.</a></li>
              <li><a href="product-list.html">Aubergine (eggplant).</a></li>
              <li><a href="product-list.html">Asparagus.</a></li>
              <li><a href="product-list.html">Broccoflower (a hybrid).</a></li>
              <li><a href="product-list.html">Broccoli (calabrese).</a></li>
            </ul>
          </li>
          <li><a  data-toggle="collapse" href="#catagory-widget7" role="button" aria-expanded="false" aria-controls="catagory-widget7">Butter & Eggs<i class="fas fa-angle-down"></i></a>
            <ul class="catagory-submenu collapse" id="catagory-widget7">
              <li><a href="product-list.html">Artichoke.</a></li>
              <li><a href="product-list.html">Aubergine (eggplant).</a></li>
              <li><a href="product-list.html">Asparagus.</a></li>
              <li><a href="product-list.html">Broccoflower (a hybrid).</a></li>
              <li><a href="product-list.html">Broccoli (calabrese).</a></li>
            </ul>
          </li>
          <li><a  data-toggle="collapse" href="#catagory-widget8" role="button" aria-expanded="false" aria-controls="catagory-widget8">Oils and Venegar<i class="fas fa-angle-down"></i></a>
            <ul class="catagory-submenu collapse" id="catagory-widget8">
              <li><a href="product-list.html">Artichoke.</a></li>
              <li><a href="product-list.html">Aubergine (eggplant).</a></li>
              <li><a href="product-list.html">Asparagus.</a></li>
              <li><a href="product-list.html">Broccoflower (a hybrid).</a></li>
              <li><a href="product-list.html">Broccoli (calabrese).</a></li>
            </ul>
          </li>
          <li><a  data-toggle="collapse" href="#catagory-widget9" role="button" aria-expanded="false" aria-controls="catagory-widget9">Frozen Food<i class="fas fa-angle-down"></i></a>
            <ul class="catagory-submenu collapse" id="catagory-widget9">
              <li><a href="product-list.html">Artichoke.</a></li>
              <li><a href="product-list.html">Aubergine (eggplant).</a></li>
              <li><a href="product-list.html">Asparagus.</a></li>
              <li><a href="product-list.html">Broccoflower (a hybrid).</a></li>
              <li><a href="product-list.html">Broccoli (calabrese).</a></li>
            </ul>
          </li>
          <li><a  data-toggle="collapse" href="#catagory-widget10" role="button" aria-expanded="false" aria-controls="catagory-widget10">Jam & Honey<i class="fas fa-angle-down"></i></a>
            <ul class="catagory-submenu collapse" id="catagory-widget10">
              <li><a href="product-list.html">Artichoke.</a></li>
              <li><a href="product-list.html">Aubergine (eggplant).</a></li>
              <li><a href="product-list.html">Asparagus.</a></li>
              <li><a href="product-list.html">Broccoflower (a hybrid).</a></li>
              <li><a href="product-list.html">Broccoli (calabrese).</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </div>

<div class="main-content-area">
<!-- page-header-section start -->
<div class="page-header-section">
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex justify-content-between justify-content-md-end">
                <ul class="breadcrumb">
                     <li><a href="<?php echo base_url('Home');?>">Home</a></li>
                    <li><span>/</span></li>
                     <li><a href="<?php echo base_url('Home');?>">Blog Page</a></li>
                    
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- page-header-section end -->


<!-- about section start -->
<section class="blog-section section-ptb">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 main-content">
                <div class="entry-wrapper">
                    <div class="entry-single">
                        <div class="entry-header">
                          
                            <img src="<?php echo base_url('uploads/blogs');?>/<?php echo $image_id->blog_images;?>" alt="">
                      
                      </div>
                        <div class="entry-content">
                            <ul class="meta-post list-unstyled pl-0 d-flex">
                               <!-- <li>
                                    <span class="icon"><i class="far fa-user"></i></span>
                                    <a href="#" class="meta-link"></a>
                                </li>-->
                                <li>
                                    <span class="icon"><i class="far fa-clock"></i></span>
                                    <span class="meta-content"><?php echo $image_id->publish_date;?></span>
                                </li>
                                <li>
                                    <span class="icon"><?php echo $countComm;?><i class="far fa-comment-alt"></i></span>
                                <a href="#" class="meta-link"></a>
                                </li>
                                <li>

                                  <!--<a href="" onClick="return active(this);" id='<?php echo $image_id->id;?>'><span class="icon"><?php echo $countlike;?><i class="far fa-heart"></i></span></a>-->

                                    <span class="meta-content"></span>
                                </li>
                            </ul>
                            <h2 class="title mb-3"><?php echo $image_id->blog_title;?></h2>
                            <p><?php echo $image_id->sort_content;?></p>
                             <p><?php echo $image_id->long_content;?></p>
                           
                        </div>
                      <ul class="tag-list list-unstyled d-flex">
                            <li class="mr-4">Tags</li>
                            <li><a href=""><?php echo $image_id->tags;?></a></li>
                          
                        </ul>

                       <!-- <ul class="share-list list-unstyled">
                            <li class="mr-4">Share</li>
                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fab fa-tumblr"></i></a></li>
                            <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                            <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                            <li><a href="#"><i class="fas fa-rss"></i></a></li>
                        </ul>-->
                    </div>



                    <div class="comment-section pt--70 pb--40">
                        <h5 class="comment-title mb--30"><i class="far fa-comment-alt"></i><?php echo $countComm;?> Comments</h5>

                          <div class="comment-list">
                               <?php 
                                       foreach($comment as $data)
                                       {

                                           $change = $data->created_on;
                                           $newDate = date('F\ jS, Y,', strtotime($change));
                                           $formate = date("h:i:a", strtotime($change));
                                         
                                        ?>

                            <div class="comment-item">
                                <div class="comment-author d-flex flex-wrap">
                                    <div class="author-image">
                                        <img src="https://www.vinaybajrangi.com/upload/category_img/43_video%20report.jpg" alt="comment author">
                                    </div>

                                    <div class="author-name-info">
                                        <h6 class="name"><?php echo $data->name;?></h6>
                                          <p class="publish-date">Posted on <?php echo $newDate;?><?php echo $formate;?></p>

                                          
                                     <p onclick="return openReplyBox('<?php echo $image_id->id;?>','<?php echo $data->comnt_id;?>')">reply</p>
                                      <div class="demo"  onclick="reply('<?php echo $data->comnt_id;?>')"></div>
  
                                    </div>
                                </div>
                                <div class="comment-content">
                                    <p><?php echo $data->comment;?></p>   
                                
                                </div>
                                   <div align="left" id="comment_ReplyBox_<?php echo $data->comnt_id;?>"></div>

                            </div>
                              <?php } ?>
                        </div>
</div>
<div class="comment-thread">
    <details open class="comment" id="comment-1">
        <summary>
            <div class="comment-heading">
                 <?php
                        foreach ($reply as $row) 
                        {
                                       $change = $row->created_on;
                                       $newDate = date('F\ jS, Y,', strtotime($change));
                                       $formate = date('h:i a', strtotime($newDate));
                                       //print_r($formate);
                        ?>
                        <div class="comment-info">
                          <a href="#" class="comment-author">

                           </a>
                      <p class="m-0">
                    </p>
                </div>
            </div>
        </summary>

        <div class="comment-body">
                   <p>
                    </p>
          
            
            <?php } ?>
           
        </div>
    </details>
    <!-- Comment 1 end -->
   </div>

                    <div class="response-comment-section">
                        <h5 class="response-commen-title mb--30">Leave A Comments</h5>
                              <form method="post" name="blog_comment" id="blog_comment"  class="respons-contact-form">
  
                              <input type="hidden" name="my_id" id="my_id" value="<?php echo $image_id->id;?>"/>

                              <div class="form-item col-lg-7 p-0">
                                <span class="name_error" style="color:red;"></span> 
                                   <input type="text" name="name" id="name" placeholder="Full Name">
                                   <i class="fas fa-user"></i>
                                     
                              </div>

                            <div class="form-item col-lg-7 p-0">
                               <span class="email_error" style="color:red;"></span>
                                <input type="text" name="email" id="email" placeholder="Enter Email">
                                <i class="fas fa-envelope"></i>
                                
                            </div>
                            <div class="form-item col-lg-12 p-0">
                                
                                 <textarea id="comment" name="comment"></textarea>
                                <i class="fab fa-telegram-plane"></i>
                                <span class="comment_error" style="color:red;"></span>
                                 
                            </div>
                             <button type="submit" class="submit" name="submit" onclick="return validatecomment();">Post Comment</button>
                        </form>
                    </div>
                </div>                            
            </div>
       
        <?php $this->load->view('blogs/right_sidebar')?>
    </div>
</section>
<!-- about section end -->

</div>
</div>

<!-- login-area -->
<!-- mobile-footer -->

<!-- mobile-footer -->
<div class="astro">
  <ul>
    <li><a href="https://www.vinaybajrangi.com/"><i class="fa fa-home"></i> <br>
      Home</a></li>
    <li><a href="https://www.vinaybajrangi.com/services.php"><img src="https://www.vinaybajrangi.com/assets/frontend/images/consultation-icon.png" style="width: 30px;"> <br>
      Consultation</a></li>
    <li><a href="tel:+919278665588"><i class="fa fa-phone"></i> <br>
      Call us</a></li>
    <li><a href="https://www.vinaybajrangi.com/today-panchang.php"><i class="far fa-calendar"></i> <br>
      Panchang</a></li>
    <li class="dropup"> <a style="width:62px;margin-bottom: -5px;display:block; overflow:hidden;" class="dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-user"></i> <br>
      My Account <span class="caret"></span></a>
      <ul class="dropdown-menu">
        <li class="signin-option"><a onclick="if (!window.__cfRLUnblockHandlers) return false; load_sign_up()" href="javascript:void(0);"><i class="fas fa-user mr-2"></i>Login/Signup</a></li>
      </ul>
    </li>
  </ul>
</div>
<a href="#top-page" class="to-top js-scroll-trigger"><span><i class="fas fa-arrow-up"></i></span></a>


<script type="text/javascript">
 document.addEventListener(
    "click",
    function(event) {
        var target = event.target;
        var replyForm;
        if (target.matches("[data-toggle='reply-form']")) {
            replyForm = document.getElementById(target.getAttribute("data-target"));
            replyForm.classList.toggle("d-none");
        }
    },
    false
);

</script>
<script type="text/javascript">

  function reply(reply)
  { 
     $.ajax({
                url:"<?php echo base_url();?>/home/reply?id="+reply,
                dataType:"JSON",
                success:function(data)
                {
                    var html = '';
                    for(var i = 0; i < data.length; i++)
                    {
                         var change = data[i].created_on;
                         var changes= moment(change).format('DD MMM YYYY, hh:mm a');
                          // var newDate = date('F\ jS, Y,', strtotime(change));
                          // var formate = date('h:i a', strtotime(newDate));
                          html += '<p>'+data[i].reply+'</p>';
                          html += '<p>'+changes+'</p>';
                    
                   
                    }
                    $('#comment_ReplyBox_'+reply).html(html);
                    //$('#comment_ReplyBox_'+reply).html(html);

               }

          });
}
    
  

        function savecomment(cmntId)
        {
          event.preventDefault();
          var form_data = new FormData();
          form_data.append('blog_id_hindi', $("#my_id_"+cmntId).val());
          form_data.append('comment_id', $("#comment_id_"+cmntId).val());
          form_data.append('message', $("#message_"+cmntId).val());

          $.ajax({
                        url: "<?php echo base_url('home/replycomment'); ?>",
                        dataType : "json",
                        type : "post",
                        cache: false,
                        contentType: false,
                        processData: false,
                        data : form_data,
                      
                        success: function(data)
                        {
                            if(data.success==true)
                            {
                            var html = '';
                            var d=data.reply;
                            for (i =0; i< d.length; i++)
                            {
                             var change = d[i].created_on;
                             var changes= moment(change).format('DD MMM YYYY, hh:mm a');
                                //html += '<p>'+d[i].reply_name+'</p>';
                                 html += '<p>'+d[i].reply+'</p>';
                                 html += '<p>'+changes+'</p>';
                                 // html += '<p>'+d[i].reply_name+'</p>';
                            }
                            $('#comment_ReplyBox_'+cmntId).html(html);                                   
                            }
                            else
                            {
                               alert(data.message);
                            }
                        }
                  });
 }
</script>



<script type="text/javascript">
  function openReplyBox(postId,cmntId){
    const formHtml=`<form method="POST" class="reply-form " id="comment-1-reply-form-${cmntId}">
                <input type="hidden" name="my_id_${cmntId}" id="my_id_${cmntId}" value="${postId}"/>
    <input type="hidden" name="comment_id_${cmntId}" id="comment_id_${cmntId}" value="${cmntId}"/>
                <textarea placeholder="Reply to comment" rows="4" name="message_${cmntId}" id="message_${cmntId}"></textarea>
                <button type="submit" onclick="return savecomment(${cmntId});">Submit</button>
                <button type="button" onclick="closeReplyBox(${cmntId})">Cancel</button>
            </form>`;
    document.getElementById('comment_ReplyBox_'+cmntId).innerHTML=formHtml;
    //savecomment(cmntId);
  }
  function closeReplyBox(replyBoxId){
    document.getElementById('comment_ReplyBox_'+replyBoxId).innerHTML='';

  }

    function validatecomment()
    {

          if(document.blog_comment.name.value.trim() == '')
          {
          $('#name').css('border', '1px solid red');
          document.blog_comment.name.focus();
          $(".name_error").html("*Enter Your Name");
          return false;
          }
          else
          {
          $('#name').css('border', '1px solid green');
          $(".name_error").html("");
          }

          if(document.blog_comment.email.value.trim() == '')
          {
          $('#email').css('border', '1px solid red');
          document.blog_comment.email.focus();
           $(".email_error").html("*Enter your email");
          return false;
          }
          else
          {
          $('#email').css('border', '1px solid green');
          $(".email_error").html("");
          }

          if(document.blog_comment.comment.value.trim() == '')
          {
          $('#comment').css('border', '1px solid red');
          document.blog_comment.comment.focus();
          $(".comment_error").html("*Write Your Comment Above");

          return false;
          }
          else
          {
          $('#comment').css('border', '1px solid green');
          $(".comment_error").html("");
          }

          event.preventDefault();
          var form_data = new FormData();
          form_data.append('blog_id_hindi', $("#my_id").val());
          form_data.append('name', $("#name").val());
          form_data.append('email', $("#email").val());
          form_data.append('comment', $("#comment").val());
       

          $.ajax({
                        url: "<?php echo base_url('home/storecomment'); ?>",
                        dataType : "json",
                        type : "post",
                        cache: false,
                        contentType: false,
                        processData: false,
                        data : form_data,
                      
                        success: function(data)
                        {
                            if(data.success==true)
                            {
                                alert(data.message);    
                                location.reload();           
                            }
                            else
                            {
                               alert(data.message);
                            }
                        }
                     

                  });
}
   

            

</script>

<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
   <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">
  function active(getid)
  { 
    var id=getid.id;
      alert('Thanku for like');
      $.ajax({
      url:"<?php echo base_url();?>/home/like",
      method:"POST",
      data: "id="+id,
      success:function(data)
      {
       
     }
   });
  }
$(document).ready(function(){
  $('.demo').trigger('click');
});
   </script>
   
</body>
</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>