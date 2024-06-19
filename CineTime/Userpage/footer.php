<footer class="footer">
<div class="container">
<div class="row">
<div class="col-lg-3 col-sm-6">
<div class="widget">
<img src="assets/img/CTlogo.png" alt="about" />
<p>MMU,Melaka</p>
<h6><span>Call us: </span>(+60) 111 222 3456</h6>
</div>
</div>
<div class="col-lg-3 col-sm-6">
<div class="widget">
<ul>
<li><a href="Aboutus.php">About Us</a></li>
<?php if ($_SESSION['user_id'] != 0) {
                    echo '<li><a href="Customer.php">My Account</a></li>';
}
                   ?>
</ul>
</div>
</div>

</div>
<hr />
</div>
<div class="copyright">
<div class="container">
<div class="row">
<div class="col-lg-6 text-center text-lg-left">
<div class="copyright-content">
<p class="no-margin-bottom">2024 &copy; CineTime.</p>
</div>
</div>
<div class="col-lg-6 text-center text-lg-right">
<div class="copyright-content">
<a href="#" class="scrollToTop">
Back to top<i class="icofont icofont-arrow-up"></i>
</a>
</div>
</div>
</div>
</div>
</div>