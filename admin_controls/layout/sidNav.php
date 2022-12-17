<?php 
    $role_data = getData_with_id('roles',$_SESSION['role']); // $_SESSION['role'] => role id
    $roles= explode("/",$role_data['authentications']);

?>
<div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">الاقسام الرئيسيه</div>
                            <a class="nav-link" href="<?php echo "admin_dash.php";?>">
                                <div class="sb-nav-link-icon"><img class="side_left_icons" src="./img/dashboard_icon.svg" alt="dashboard_icon"></div>
                                لوحة التحكم
                            </a>
                            <div class="sb-sidenav-menu-heading">الاقسام</div>
                            
                            
                            <!-- ============= start role section ============== -->
                            <?php if(in_array("all_role",$roles) || in_array("add_role",$roles)){?>
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts1" aria-expanded="false" aria-controls="collapseLayouts1">
                                    <div class="sb-nav-link-icon"><img class="side_left_icons" src="./img/rules.svg" alt="rules"></div>
                                    الصلاحيات
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapseLayouts1" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        
                                        <?php if(in_array("add_role",$roles)){?>
                                            <a class="nav-link" href="<?php echo "add_role_admin.php?to=role";?>">اضافة صلاحيه</a>
                                        <?php } ?>
                                        <?php if(in_array("all_role",$roles)){?>
                                            <a class="nav-link" href="<?php echo "all_role_admin.php?to=role";?>">تعديل / حذف صلاحيه</a>
                                        <?php } ?>
                                    </nav>
                                </div>
                            <?php } ?>

                            <!-- ============= start admin section ============== -->
                            <?php if(in_array("all_admin",$roles) || in_array("add_admin",$roles)){?>
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts2" aria-expanded="false" aria-controls="collapseLayouts2">
                                    <div class="sb-nav-link-icon"><img class="side_left_icons" src="./img/admin_icon.svg" alt="admins"></div>
                                    المسئولين
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapseLayouts2" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <?php if(in_array("add_admin",$roles)){?>
                                            <a class="nav-link" href="<?php echo "add_role_admin.php";?>">اضافة مسئول</a>
                                        <?php } ?>
                                        <?php if(in_array("all_admin",$roles)){?>
                                            <a class="nav-link" href="<?php echo "all_role_admin.php";?>">تعديل / حذف مسئول</a>
                                        <?php } ?>
                                    </nav>
                                </div>
                            <?php } ?>
                            
                            <!-- ============= start university section ============== -->
                            <?php if(in_array("all_universities",$roles) || in_array("add_university",$roles)){?>
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts3" aria-expanded="false" aria-controls="collapseLayouts3">
                                    <div class="sb-nav-link-icon"><img class="side_left_icons" src="./img/university.svg" alt="university"></div>
                                    الجامعات
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapseLayouts3" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        
                                        <?php if(in_array("add_university",$roles)){?>
                                            <a class="nav-link" href="<?php echo "add_university_faculty.php?to=university";?>">اضافة جامعه</a>
                                        <?php } ?>
                                        <?php if(in_array("all_universities",$roles)){?>
                                            <a class="nav-link" href="<?php echo "all_universities_faculties.php?to=university";?>">تعديل / حذف جامعه</a>
                                        <?php } ?>
                                    </nav>
                                </div>
                            <?php } ?>
                            
                            <!-- ============= start faculty section ============== -->
                            <?php if(in_array("all_universities",$roles) || in_array("add_faculty",$roles)){?>
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts4" aria-expanded="false" aria-controls="collapseLayouts4">
                                    <div class="sb-nav-link-icon"><img class="side_left_icons" src="./img/faculty.svg" alt="faculty"></div>
                                    الكليات
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapseLayouts4" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        
                                        <?php if(in_array("add_faculty",$roles)){?>
                                            <a class="nav-link" href="<?php echo "add_university_faculty.php";?>">اضافة كلية</a>
                                        <?php } ?>
                                        <?php if(in_array("all_universities",$roles)){?>
                                            <a class="nav-link" href="<?php echo "all_universities_faculties.php";?>">تعديل / حذف كلية</a>
                                        <?php } ?>
                                    </nav>
                                </div>
                            <?php } ?>

                            <!-- ============= start faculty section ============== -->
                            <?php if(in_array("all_universities",$roles) || in_array("add_faculty",$roles)){?>
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts5" aria-expanded="false" aria-controls="collapseLayouts5">
                                    <div class="sb-nav-link-icon"><img class="side_left_icons" src="./img/academic_years.svg" alt="academic_years"></div>
                                    الاعوام الدراسيه
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapseLayouts5" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        
                                        <?php if(in_array("add_faculty",$roles)){?>
                                            <a class="nav-link" href="<?php echo "add_academice_subject.php?to=academic_years";?>">اضافة عام دراسي</a>
                                        <?php } ?>
                                        <?php if(in_array("all_universities",$roles)){?>
                                            <a class="nav-link" href="<?php echo "all_academice_subject.php?to=academic_years";?>">تعديل / حذف عام دراسي</a>
                                        <?php } ?>
                                    </nav>
                                </div>
                            <?php } ?>

                            <!-- ============= start subjects section ============== -->
                            <?php if(in_array("all_universities",$roles) || in_array("add_faculty",$roles)){?>
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts6" aria-expanded="false" aria-controls="collapseLayouts6">
                                    <div class="sb-nav-link-icon"><img class="side_left_icons" src="./img/subjects.svg" alt="subjects"></div>
                                    المواد الدراسيه
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapseLayouts6" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        
                                        <?php if(in_array("add_faculty",$roles)){?>
                                            <a class="nav-link" href="<?php echo "add_academice_subject.php";?>">اضافة ماده دراسيه</a>
                                        <?php } ?>
                                        <?php if(in_array("all_universities",$roles)){?>
                                            <a class="nav-link" href="<?php echo "all_academice_subject.php";?>">تعديل / حذف ماده دراسيه</a>
                                        <?php } ?>
                                    </nav>
                                </div>
                            <?php } ?>

                            <!-- ============= start doctors section ============== -->
                            <?php if(in_array("all_doctors",$roles) || in_array("add_doctor",$roles)){?>
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts7" aria-expanded="false" aria-controls="collapseLayouts7">
                                    <div class="sb-nav-link-icon"><img class="side_left_icons" src="./img/doctor.svg" alt="doctor"></div>
                                    الدكاتره
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapseLayouts7" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        
                                        <?php if(in_array("add_doctor",$roles)){?>
                                            <a class="nav-link" href="<?php echo "add_doctor.php";?>">اضافة دكتور</a>
                                        <?php } ?>
                                        <?php if(in_array("all_doctors",$roles)){?>
                                            <a class="nav-link" href="<?php echo "all_doctors.php";?>">تعديل / حذف دكتور</a>
                                        <?php } ?>
                                    </nav>
                                </div>
                            <?php } ?>

                            <!-- ============= start courses section ============== -->
                            <?php if(in_array("all_courses",$roles) || in_array("add_courses",$roles)){?>
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts8" aria-expanded="false" aria-controls="collapseLayouts8">
                                    <div class="sb-nav-link-icon"><img class="side_left_icons" src="./img/courses.svg" alt="courses"></div>
                                    الكورسات
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapseLayouts8" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        
                                        <?php if(in_array("add_courses",$roles)){?>
                                            <a class="nav-link" href="<?php echo "add_courses.php";?>">اضافة كورسات</a>
                                        <?php } ?>
                                        <?php if(in_array("all_courses",$roles)){?>
                                            <a class="nav-link" href="<?php echo "all_courses.php";?>">تعديل / حذف كورسات</a>
                                        <?php } ?>
                                    </nav>
                                </div>
                            <?php } ?>

                            <!-- ============= start departments section ============== -->
                            <?php if(in_array("all_dep",$roles) || in_array("add_dep",$roles)){?>
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts12" aria-expanded="false" aria-controls="collapseLayouts12">
                                    <div class="sb-nav-link-icon"><img class="side_left_icons" src="./img/departments.svg" alt="departments"></div>
                                    الاقسام
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapseLayouts12" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        
                                        <?php if(in_array("add_dep",$roles)){?>
                                            <a class="nav-link" href="<?php echo "add_department.php";?>">اضافة قسم</a>
                                        <?php } ?>
                                        <?php if(in_array("all_dep",$roles)){?>
                                            <a class="nav-link" href="<?php echo "all_department.php";?>">تعديل / حذف قسم</a>
                                        <?php } ?>
                                    </nav>
                                </div>
                            <?php } ?>

                            <!-- ============= start videos section ============== -->
                            <?php if(in_array("add_videos",$roles) || in_array("add_videos",$roles)){?>
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts9" aria-expanded="false" aria-controls="collapseLayouts9">
                                    <div class="sb-nav-link-icon"><img class="side_left_icons" src="./img/videos.svg" alt="videos"></div>
                                    الفيديوهات
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapseLayouts9" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        
                                        <?php if(in_array("add_videos",$roles)){?>
                                            <a class="nav-link" href="<?php echo "add_videos.php";?>">اضافة فيديوهات</a>
                                        <?php } ?>
                                        <?php if(in_array("add_videos",$roles)){?>
                                            <a class="nav-link" href="<?php echo "all_videos.php";?>">تعديل / حذف فيديوهات</a>
                                        <?php } ?>
                                    </nav>
                                </div>
                            <?php } ?>

                            <!-- ============= start coupone section ============== -->
                            <?php if(in_array("add_coupone",$roles) || in_array("all_coupone",$roles)){?>
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts10" aria-expanded="false" aria-controls="collapseLayouts10">
                                    <div class="sb-nav-link-icon"><img class="side_left_icons" src="./img/coupon.svg" alt="coupone"></div>
                                    كوبونات الخصم
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapseLayouts10" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        
                                        <?php if(in_array("add_coupone",$roles)){?>
                                            <a class="nav-link" href="<?php echo "add_coupone.php";?>">اضافة كوبون خصم</a>
                                        <?php } ?>
                                        <?php if(in_array("all_coupone",$roles)){?>
                                            <a class="nav-link" href="<?php echo "all_coupones.php";?>">تعديل / حذف كوبون خصم</a>
                                        <?php } ?>
                                    </nav>
                                </div>
                            <?php } ?>


                            <div class="sb-sidenav-menu-heading">ادارة الموقع وعرض البيانات</div>

                            <!-- ============= start all_students section ============== -->
                            <?php if(in_array("all_students",$roles)){?>
                                <a class="nav-link" href="<?php echo "all_students.php";?>">
                                    <div class="sb-nav-link-icon"><img class="side_left_icons" src="./img/students.svg" alt="students"></div>
                                    جميع المستخدمين
                                </a>
                            <?php } ?>

                            <!-- ============= start all_activation_codes section ============== -->
                            <?php if(in_array("all_activation_codes",$roles)){?>
                                <a class="nav-link" href="<?php echo "all_verification_code.php";?>">
                                    <div class="sb-nav-link-icon"><img class="side_left_icons" src="./img/students.svg" alt="students"></div>
                                    جميع اكواد تفعيل الايميلات
                                </a>
                            <?php } ?>

                            <!-- ============= start all_forgetpassword_codes section ============== -->
                            <?php if(in_array("all_forgetpassword_codes",$roles)){?>
                                <a class="nav-link" href="<?php echo "all_forgetpassword_codes.php";?>">
                                    <div class="sb-nav-link-icon"><img class="side_left_icons" src="./img/devices.svg" alt="students"></div>
                                    جميع اكواد نسيان كلمة السر
                                </a>
                            <?php } ?>

                            <!-- ============= start all_payments_requests section ============== -->
                            <?php if(in_array("all_payments_requests",$roles)){?>
                                <a class="nav-link" href="<?php echo "payment_requests.php";?>">
                                    <div class="sb-nav-link-icon"><img class="side_left_icons" src="./img/payments_icon.svg" alt="payments_icon"></div>
                                    جميع طلبات الشراء
                                </a>
                            <?php } ?>

                            <!-- ============= start all_blocked_students section ============== -->
                            <?php if(in_array("all_blocked_students",$roles)){?>
                                <a class="nav-link" href="<?php echo "all_blocked_students.php";?>">
                                    <div class="sb-nav-link-icon"><img class="side_left_icons" src="./img/blocked_students.svg" alt="blocked_students"></div>
                                    المستخدمين المحظورين
                                </a>
                            <?php } ?>

                            <!-- ============= start all_students_videos section ============== -->
                            <?php if(in_array("all_students_videos",$roles)){?>
                                <a class="nav-link" href="<?php echo "all_students_videos.php";?>">
                                    <div class="sb-nav-link-icon"><img class="side_left_icons" src="./img/students_videos.svg" alt="students_videos"></div>
                                    الفيديوهات المسجله
                                </a>
                            <?php } ?>

                            <!-- ============= start all_gifted_videos section ============== -->
                            <?php if(in_array("all_gifted_videos",$roles)){?>
                                <a class="nav-link" href="<?php echo "all_gifted_videos.php";?>">
                                    <div class="sb-nav-link-icon"><img class="side_left_icons" src="./img/gifted_videos.svg" alt="gifted_videos"></div>
                                    الفيديوهات المهداه
                                </a>
                            <?php } ?>

                            <!-- ============= start all_videos_statistics section ============== -->
                            <?php if(in_array("all_videos_statistics",$roles)){?>
                                <a class="nav-link" href="<?php echo "all_videos_statistics.php";?>">
                                    <div class="sb-nav-link-icon"><img class="side_left_icons" src="./img/purchase_times.svg" alt="purchase_times"></div>
                                    مرات شراء الفيديوهات
                                </a>
                            <?php } ?>

                            <!-- ============= start all_years_sold_videos section ============== -->
                            <?php if(in_array("all_years_sold_videos",$roles)){?>
                                <a class="nav-link" href="all_years_sold_videos.php">
                                    <div class="sb-nav-link-icon"><img class="side_left_icons" src="./img/statistics.svg" alt="statistics"></div>
                                    احصائيات السنين الدراسيه  
                                </a>
                            <?php } ?>

                            <!-- ============= start all_students_ips section ============== -->
                            <?php if(in_array("all_students_ips",$roles)){?>
                                <a class="nav-link" href="all_students_ips.php">
                                    <div class="sb-nav-link-icon"><img class="side_left_icons" src="./img/devices.svg" alt="devices"></div>
                                    اجهزة الطلاب المسجله
                                </a>
                            <?php } ?>

                            <!-- ============= start order_pdf section ============== -->
                            <?php if(in_array("order_pdf",$roles)){?>
                                <a class="nav-link" href="order_pdf.php">
                                    <div class="sb-nav-link-icon"><img class="side_left_icons" src="./img/print.svg" alt="print"></div>
                                    تسليم المحاضرات للطلاب
                                </a>
                            <?php } ?>

                            <!-- ============= start request_type section ============== -->
                            <?php if(in_array("payments",$roles)){?>
                                <a class="nav-link" href="payments.php">
                                    <div class="sb-nav-link-icon"><img class="side_left_icons" src="./img/payments_icon.svg" alt="payments_icon"></div>
                                    عمليات الدفع
                                </a>
                            <?php } ?>

                            <!-- ============= start contact_request section ============== -->
                            <?php if(in_array("contact_request",$roles)){?>
                                <a class="nav-link" href="all_incomming_emails.php">
                                    <div class="sb-nav-link-icon"><img class="side_left_icons" src="./img/messages.svg" alt="messages"></div>
                                    طلبات المراسلة  
                                </a>
                            <?php } ?>
                        
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">اهلا بك في لوحة تحكم  

                        </div>
                        جامعتي
                    </div>
                </nav>
            </div>

