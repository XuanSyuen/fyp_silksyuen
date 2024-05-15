<section class="mailchimp-section">
	<div class="box">
		<h3 class="sec-title">Get Discount 30% Off</h3>
    	<form class="mailchimp-form" action="#" method="post">
            <input type="email" name="email" placeholder="your email">
            <button type="submit">Subscribe</button>
        </form>
        <div class="mailchimp-shape">
        	<img src="images/shape-mail.png" alt="">
        </div>
    </div>
</section>

<section class="copyright-section">
	<div class="copyrightbox">
		<div class="left">
           	<ul class="menu-link">
               <li><a href="admin/index.php">Admin Login</a></li>
               <li><a href="#">Terms of Service</a></li>
            </ul>
        </div>

        <div id="google_translate_element"></div>

        <div class="right">
            <div class="copys-text"><i class="fa-regular fa-copyright"></i> Copyright SilkSyuen 2024 | All Rights Reserved</div>
        </div>
    </div>
</section>

<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

<script src="js/jquery.js"></script>
<script src="js/common.js"></script>

<script type="text/javascript">
	$(document).ready(function(){

		$('#menuM').on('click', function(){

			if($('#m-menu').hasClass('active')){
				$('#m-menu').removeClass('active');
			}else{
				$('#m-menu').addClass('active');
			}

		});

		var cid = '<?php echo $cid; ?>';
		if(cid !== ""){
			checkCart();
		}
	});

	function checkCart(){

		var uid = '<?php echo $cid; ?>';
		var param = {
            'uid': uid,
            'checkCart': 1
        }

         $.ajax({
            type: "POST",
            url: "function.php",
            data: param,
            cache: false,
            dataType: "json",
            success: function(data) {

           		if(data.total > 0){
           			$('.cartamount').html(`<span>${data.total}</span>`);
           		}else{
           			$('.cartamount').html('');
           		}

            },
            error: function(data){
            
            }
        });
	}

    function AddCart(pid){

        var productid = pid;
        var uid = '<?php echo $cid; ?>';
        var param = {
            'pid' : productid,
            'uid': uid,
            'qty': 1,
            'addCart': 1
        }

        $.ajax({
            type: "POST",
            url: "function.php",
            data: param,
            cache: false,
            dataType: "json",
            success: function(data) {

           
                alert(data.msg);
           		if(data.total !== undefined){
           			$('.cartamount').html(`<span>${data.total}</span>`);
           		}
              

            },
            error: function(data){
            
            }
        });

    }        
</script>