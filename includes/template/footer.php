    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script src="<?php echo $jsPath?>nav-bar.js"></script>

    <?php if($page_name == "عربة التسوق" || $page_name == "المحاضرات" || $page_name == "السنين الدراسيه" || $page_name == "الكورسات" || $page_name == "التسجيل في الموقع" || $page_name == "الكورسات المسجله" || $page_name == "الصفحه الشخصيه" || $page_name == "عمليات الدفع" || $page_name == "المواد الدراسيه"){?>
      <script src="<?php echo $jsPath?>semantic.min.js"></script>
   <?php }
    ?>

    
    <?php if($page_name == "الرئيسيه"){?>
      <script src="<?php echo $jsPath?>mixitup.min.js"></script>
    <?php }
    ?>

<?php if($page_name == "الرئيسيه" || $page_name == "من نحن"){?>
      <script
          src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
          integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
          crossorigin="anonymous"
          referrerpolicy="no-referrer"
        ></script>
    <?php }
    ?>

   <!--Start of Tawk.to Script-->
<!-- <script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/633c7cea37898912e96ce0d8/1gei4ftjg';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script> -->
<!--End of Tawk.to Script-->


<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/633c7cea37898912e96ce0d8/1gei4ftjg';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->




    <?php if(isset($script)){ ?>
    <script src="<?php echo $jsPath?><?php echo $script?>"></script>
    <?php }?>
</body>
</html>