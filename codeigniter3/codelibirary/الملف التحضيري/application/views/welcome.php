 <!-- Home Banner -->
 <section class="section section-search">
 	<div class="container-fluid">
 		<div class="banner-wrapper">
 			<div class="banner-header text-center">
 				<h1>البحث عن طبيب والحجز</h1>
 				<p>اكتشف أفضل الأطباء والعيادات والمستشفيات في المنطقة الأقرب إليك.</p>
 			</div>
 			<!-- Search -->
 			<div class="search-box">
 				<form action="templateshub.net">
 					<div class="form-group search-location">
 						<select class="form-control">
 							<option disabled selected> اختر منطقة العيادة </option>
 							<option value="الجزائر">الجزائر</option>
 							<option value="العباسية">العباسية</option>
 							<option value="الجمهورية">الجمهورية</option>
 							<option value="خمسميل">خمسميل</option>
 						</select>
 					</div>
 					<div class="form-group ">
 						<select class="form-control">
 							<option disabled selected> اختر تخصص الطبيب </option>
 							<option value="الجزائر"> أسنان</option>
 							<option value="العباسية"> اعصاب</option>
 							<option value="الجمهورية"> مسالك بولية</option>
 							<option value="خمسميل">امراض السكري والضغط</option>
 						</select>
 					</div>
 					&nbsp;
 					&nbsp;
 					<div class="form-group  ">
 						<input list="encodings" placeholder="اسم الطبيب" value="" class="col-sm-12 custom-select  form-control custom-select-sm">
 						<datalist id="encodings">
 							<option value="علي احمد حسن">علي احمد حسن</option>
 							<option value="كاظم محمد علي">كاظم محمد علي</option>
 							<option value="غسان عدنان عادل">غسان عدنان عادل</option>
 						</datalist>
 						<!-- <input type="text" class="form-control" placeholder="اسم الطبيب"> -->
 					</div>
 					&nbsp;
 					<a type="submit" href="find" class="btn btn-primary search-btn"><i class="fas fa-search"></i> </a>
 				</form>
 			</div>
 			<!-- /Search -->
 		</div>
 	</div>
 </section>
 <!-- /Home Banner -->
 <!-- Clinic and Specialities -->
 <section class="section section-specialities">
 	<div class="container-fluid">
 		<div class="section-header text-center">
 			<h2>العيادات والتخصصات</h2>
 		</div>
 		<div class="row justify-content-center">
 			<div class="col-md-9">
 				<!-- Slider -->
 				<div class="specialities-slider slider">
 					<!-- Slider Item -->
 					<div class="speicality-item text-center">
 						<div class="speicality-img">
 							<img src="<?php echo  base_url("template") . ' /';    ?>assets/img/specialities/specialities-01.png" class="img-fluid" alt="Speciality">
 							<span><i class="fa fa-circle" aria-hidden="true"></i></span>
 						</div>
 						<p>مسالك بولية</p>
 					</div>
 					<!-- /Slider Item -->
 					<!-- Slider Item -->
 					<div class="speicality-item text-center">
 						<div class="speicality-img">
 							<img src="<?php echo  base_url("template") . ' /';    ?>assets/img/specialities/specialities-02.png" class="img-fluid" alt="Speciality">
 							<span><i class="fa fa-circle" aria-hidden="true"></i></span>
 						</div>
 						<p>طب اعصاب</p>
 					</div>
 					<!-- /Slider Item -->
 					<!-- Slider Item -->
 					<div class="speicality-item text-center">
 						<div class="speicality-img">
 							<img src="<?php echo  base_url("template") . ' /';    ?>assets/img/specialities/specialities-03.png" class="img-fluid" alt="Speciality">
 							<span><i class="fa fa-circle" aria-hidden="true"></i></span>
 						</div>
 						<p>عظام وكسور</p>
 					</div>
 					<!-- /Slider Item -->
 					<!-- Slider Item -->
 					<div class="speicality-item text-center">
 						<div class="speicality-img">
 							<img src="<?php echo  base_url("template") . ' /';    ?>assets/img/specialities/specialities-04.png" class="img-fluid" alt="Speciality">
 							<span><i class="fa fa-circle" aria-hidden="true"></i></span>
 						</div>
 						<p>قلب</p>
 					</div>
 					<!-- /Slider Item -->
 					<!-- Slider Item -->
 					<div class="speicality-item text-center">
 						<div class="speicality-img">
 							<img src="<?php echo  base_url("template") . ' /';    ?>assets/img/specialities/specialities-05.png" class="img-fluid" alt="Speciality">
 							<span><i class="fa fa-circle" aria-hidden="true"></i></span>
 						</div>
 						<p> طب وتجميل أسنان</p>
 					</div>
 					<!-- /Slider Item -->
 				</div>
 				<!-- /Slider -->
 			</div>
 		</div>
 	</div>
 </section>
 <!-- Clinic and Specialities -->
 <!-- Popular Section -->
 <section class="section section-doctor">
 	<div class="container-fluid">
 		<div class="row">
 			<div class="col-lg-8">
 				<div class="doctor-slider slider">
 					<!-- Doctor Widget -->
 					<div class="profile-widget text-center">
 						<div class="doc-img">
 							<a href="doctor-profile.html">
 								<img class="img-fluid" alt="User Image" src="<?php echo  base_url("template") . ' /';    ?>assets/img/doctors/doctor-02.jpg">
 							</a>
 						</div>
 						<div class="pro-content">
 							<h3 class="title">
 								<a href="doctor-profile.html">اسم الطبيب</a>
 								<i class="fas fa-check-circle verified"></i>
 							</h3>
 							<p class="speciality">التخصص والشهادة</p>
 							<ul class="available-info">
 								<li>
 									<i class="fas fa-map-marker-alt"></i>البصرة, العباسية
 								</li>
 								<span class="badge bg-success-light">متواجد اليوم </span>
 								<li>
 									<i class="fas fa-clock"></i><span> من الساعة 9 صباحاً الى الساعة 10 مساءً</span>
 								</li>
 								<li>
 									<i class="far fa-money-bill-alt"></i>كلفة الحجز :30 الف
 								</li>
 							</ul>
 							<div class="row row-sm">
 								<div class="col-6">
 									<a href="<?php echo base_url(); ?>Doctorprofile" class="btn view-btn">الملف الشخصي</a>
 								</div>
 								<div class="col-6">
 									<a href="<?php echo base_url(); ?>booking" class="btn book-btn">حجز موعد</a>
 								</div>
 							</div>
 						</div>
 					</div>
 					<!-- /Doctor Widget -->
 					<!-- Doctor Widget -->
 					<div class="profile-widget  text-center">
 						<div class="doc-img">
 							<a href="doctor-profile.html">
 								<img class="img-fluid" alt="User Image" src="<?php echo  base_url("template") . ' /';    ?>assets/img/doctors/doctor-08.jpg">
 							</a>
 						</div>
 						<div class="pro-content">
 							<h3 class="title">
 								<a href="doctor-profile.html">اسم الطبيب</a>
 								<i class="fas fa-check-circle verified"></i>
 							</h3>
 							<p class="speciality">التخصص والشهادة</p>
 							<ul class="available-info">
 								<li>
 									<i class="fas fa-map-marker-alt"></i> البصرة, الجمهورية
 								</li>
 								<span class="badge bg-danger-light"  >غير متواجد اليوم </span>
 								<li>
 									<i class="far fa-money-bill-alt"></i>كلفة الحجز :15 الف
 								</li>
 							</ul>
 							<div class="row row-sm">
 								<div class="col-6">
 									<a href="<?php echo base_url(); ?>Doctorprofile" class="btn view-btn">الملف الشخصي</a>
 								</div>
 								<div class="col-6">
 									<a href="<?php echo base_url(); ?>booking"   class="btn book-btn  ">حجز موعد</a>
 								</div>
 							</div>
 						</div>
 					</div>
 					<!-- Doctor Widget -->
 				</div>
 			</div>
 			<div class="col-lg-4 text-right">
 				<div class="section-header ">
 					<h2>طريقة الحجز</h2>
 					<p>شرح </p>
 				</div>
 				<div class="about-content">
 					<p>شرح</p>
 					<p>شرح</p>
 					<a href=" <?php echo base_url();  ?>doctors">عرض جميع الأطباء</a>
 				</div>
 			</div>
 		</div>
 	</div>
 </section>
 <!-- /Popular Section -->
 <!-- Availabe Features -->
 <!-- Availabe Features -->