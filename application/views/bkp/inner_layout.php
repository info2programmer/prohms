<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<?php echo $head; ?>

</head>



<body>

	<div class="website_body">

    	<div class="header">

           <?php echo $header; ?>

        </div>    

            

            <?php echo $banner; ?>

            

            <div class="inner_page">

            	<div class="container inner_page_bg">
				<?php
				if($this->uri->segment(2)!='contact_us') { ?>
                	<div class="row">

                    	<?php echo $sidebar; ?>

                        <div class="col-md-9">

                        	<div class="inner_content">

                                <?php echo $maincontents; ?> 

                			</div>

                        </div>

                    </div>
				<?php } else { ?>
                 <?php echo $maincontents; ?>
                <?php } ?>
                </div>

            </div>

            

            

            

            

            

            <footer class="footer">

                <?php echo $footer; ?>

  			</footer>    	

    </div>

</body>



<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script> 



<script type="text/javascript" src="<?php echo base_url(); ?>material/js/bootstrap.min.js"/></script>

<script src="<?php echo base_url(); ?>material/js/flexslider.js"></script> 

<script src="<?php echo base_url(); ?>material/js/jquery.mCustomScrollbar.concat.min.js"></script> 



<script type="text/javascript">



$(document).ready(function() {

$('.thumbnail').click(function(){

      $('.modal-body').empty();

  	var title = $(this).parent('a').attr("title");

  	$('.modal-title').html(title);

  	$($(this).parents('div').html()).appendTo('.modal-body');

  	$('#myModal').modal({show:true});

});

});





jQuery(function($){

	

$(".scroll").mCustomScrollbar({theme:"dark-3", scrollButtons:{ enable: true }});



  $('#main-slider').flexslider();







  jQuery('.box').niceScroll({



    autohidemode:false,



    scrollspeed: 100,



    cursorcolor: '#d84949',



    cursorwidth: '15px',



    cursorborderradius: '0px',



    cursorborder: '0',



    background: '#dddddd'



  });



});



/* ]]> */



</script>

<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>-->

<script>

$(document).ready(function () {

//alert(screen.width);

    if (screen.width < 768) {

        $(".mydropdown").hide();

    }

    



});



</script>



</html>

