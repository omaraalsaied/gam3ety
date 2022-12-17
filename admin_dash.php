<?php
    ob_start();
    session_start();
    $page_name = "";
    $style="dash_page.css";
    $script="dash_page.js";
    require "init.php";
    require './layout/topNav.php';
    if(isset($_SESSION['admin_id'])){ 

// $all_users = getAllData("members")
?>
    
    <div id="layoutSidenav">
           
 <?php 
    require './layout/sidNav.php';

 ?>

            <div id="layoutSidenav_content">

            
                  <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">جامعتي</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">لوحة تحكم جامعتي</li>
                        </ol>

                        <div class="header_cards">
                            <div class="row">

                                <div class="col-md-3 col-sm-6">
                                    <div class="items">    
                                        <div class="left col-5">
                                            <img style="color:red" src="img/courses_home.svg" alt="courses_home">
                                        </div>
                                        <div class="right col-7">
                                            <h3 class="number">
                                                <?php echo count_courses(); ?>
                                            </h3>
                                            <p class="desc">
                                                الكورسات
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 col-sm-6">
                                    <div class="items">    
                                        <div class="left col-5">
                                            <img style="color:red" src="img/videos_home.svg" alt="videos_home">
                                        </div>
                                        <div class="right col-7">
                                            <h3 class="number">
                                                <?php echo count_videos(); ?>
                                            </h3>
                                            <p class="desc">
                                                الفيديوهات
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 col-sm-6">
                                    <div class="items">    
                                        <div class="left col-5">
                                            <img style="color:red" src="img/students_home.svg" alt="students_home">
                                        </div>
                                        <div class="right col-7">
                                            <h3 class="number">
                                                <?php echo count_students(); ?>
                                            </h3>
                                            <p class="desc">
                                            المستخدمين
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 col-sm-6">
                                    <div class="items">    
                                        <div class="left col-5">
                                        <img style="color:red" src="img/university_home.svg" alt="university_home">
                                        </div>
                                        <div class="right col-7">
                                            <h3 class="number">
                                                <?php echo count_faculty(); ?>
                                            </h3>
                                            <p class="desc">
                                                الكليات
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- second_row -->
                            <div class="row mt-3">

                                <div class="col-md-3 col-sm-6">
                                    <div class="items">    
                                        <div class="left col-5">
                                            <img style="color:red" src="img/admin.svg" alt="admin">
                                        </div>
                                        <div class="right col-7">
                                            <h3 class="number">
                                                <?php echo count_all_admins(); ?>
                                            </h3>
                                            <p class="desc">
                                                المسئولين
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 col-sm-6">
                                    <div class="items">    
                                        <div class="left col-5">
                                            <img style="color:red" src="img/messages (2).svg" alt="news">
                                        </div>
                                        <div class="right col-7">
                                            <h3 class="number">
                                                <?php echo count_all_messages(); ?>
                                            </h3>
                                            <p class="desc">
                                                الرسائل
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 col-sm-6">
                                    <div class="items">    
                                        <div class="left col-5">
                                            <img style="color:red" src="img/payments.svg" alt="payments">
                                        </div>
                                        <div class="right col-7">
                                            <h3 class="number">
                                                <?php echo count_all_payments(); ?>
                                            </h3>
                                            <p class="desc">
                                                عمليات الدفع
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 col-sm-6">
                                    <div class="items">    
                                        <div class="left col-5">
                                        <img style="color:red" src="img/roles_home.svg" alt="roles_home">
                                        </div>
                                        <div class="right col-7">
                                            <h3 class="number">
                                                <?php echo count_all_roles(); ?>
                                            </h3>
                                            <p class="desc">
                                               الصلاحيات
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
              <?php 

                    // $day =date("d");
                    // $month = date("m");
                    // $year = date("Y");
                    // $arr=[];
                    // for($i = 0;$i<4;$i++){
                    //     $days = date('d/m',strtotime('-'. $i . ' days',strtotime(str_replace('/', '-', $day ."/".$month."/".$year)))) . PHP_EOL . "<br>";
                    //     $arr[$i] = $days;
                    // }
                    // print_r($arr);

                    // $videos = getAllData("courses_videos");
                    //     foreach($videos as $vid){
                    //     $ex = explode(" . ",$vid["created_at"]);
                    //     $ex2 = explode("/",$ex[0]);
                    //     $day2 = $ex2[2];
                    //     $month2 = $ex2[1];
                    //     $year2 = $ex2[0];
                    //     // echo $month2;
                    //     $day_month = $day2 . "/" . $month2;
                    //     echo $day_month;
                    //     if($day_month == $arr[2]){
                    //         echo $vid["name"];
                    //     }
                    // }

                ?>

                <!-- ==============charts============= -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="charts_container">
                                <p class="text-center">اعداد (المستخدمين , الكورسات , الفيديوهات)</p>
                                <canvas class="charts" id="myChart1"></canvas>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="charts_container">
                                <p class="text-center"> عدد فيديوهات الكورسات</p>
                                <canvas class="charts" id="myChart3"></canvas>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="charts_container">
                                <p class="text-center">  فيديوهات الكورسات</p>
                                <canvas class="charts" id="myChart4"></canvas>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="charts_container">
                                <p class="text-center"> مرات شراء الفيديوهات</p>
                                <canvas class="charts" id="myChart5"></canvas>
                            </div>
                        </div>
                        <!-- <div class="col-md-12 mt-5">
                            <div class="charts_container">
                                <p class="text-center"> اماكن بنك الدم في المحافظات</p>
                                <canvas class="charts_circle" id="myChart2"></canvas>
                            </div>
                        </div> -->
                        
                    </div>



                        <?php
                            $blood = getAllData("courses");
                            $courses = getAllData("courses");
                            $videos = getAllData("courses_videos");
                                            $i=0;
                        ?>

                           <script>

                            // ===================== chart 1 =====================
                            const labels = [<?php echo "'الطلاب'" . "," . "'الكورسات'" . "," . "'الفيديوهات'" ?>];
                            
                            const data1 = {
                                labels: labels,
                                datasets: [{
                                  label: 'احصائيات عامه',
                                  backgroundColor: 'rgba(255, 99, 132,.5)',
                                  borderColor: 'rgb(255, 99, 132)',
                                  data: [
                                    <?php 
                                        echo count_students() . "," . count_courses() . "," . count_videos();
                                    ?>
                                  ],
                                  fill: true,
                                  tension: .5
                                }]
                              };
                              
                              // ===================== chart 3 =====================
                            const labels3 =[ <?php foreach($courses as $course_data){
                                     
                                     echo "'" . $course_data["name"] . "'" . ",";
                                  
                                 }?>];
                            const data3 = {
                            labels: labels3,
                            datasets: [{
                                label: 'عدد فيديوهات الكورسات',
                                data:  [<?php
                                    foreach($courses as $course_data){
                                     
                                        echo "'" . count_video_by_course($course_data["id"]) . "'" . ",";
                                        
                                     
                                    }
                                  ?>],
                                backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 205, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(201, 203, 207, 0.2)'
                                ],
                                borderColor: [
                                'rgb(255, 99, 132)',
                                'rgb(255, 159, 64)',
                                'rgb(255, 205, 86)',
                                'rgb(75, 192, 192)',
                                'rgb(54, 162, 235)',
                                'rgb(153, 102, 255)',
                                'rgb(201, 203, 207)'
                                ],
                                borderWidth: 1
                            }]
                            };


                            
                                // ===================== chart 2 (الدايره) =====================
    
                                const data2 = {
                                labels:[ <?php foreach($videos as $videos_data){
                                            
                                            echo "'" . $videos_data["video_name"] . "'" . ",";
                                        
                                        }?>],
                                datasets: [{
                                    label: 'مرات شراء الفيديوهات',
                                    data: [<?php
                                        foreach($videos as $videos_data){
                                            
                                            echo "'" . count_bought_videos($videos_data["id"]) . "'" . ",";
                                            
                                        }
                                        ?>],
                                    hoverOffset: 4,
                                    fill: false,
                                        tension: 1
                                }]
                                };

                            // ===================== chart 5 =====================
                            const labels5 = [<?php $time=0; foreach($videos as $videos_data){
                                $time++;
                                        if($time<6){
                                            if(count_bought_videos($videos_data["id"]) >0){
                                                echo "'" . $videos_data["video_name"] . "'" . ",";
                                            }   
                                        }
                                        }?>];
                            
                            const data5 = {
                                labels: labels5,
                                datasets: [{
                                label: 'مرات شراء الفيديوهات',
                                fill: true,
                                borderColor: 'rgb(40, 146, 253)',
                                backgroundColor: 'rgba(40, 146, 253,.3)',
                                tension: .3,
                                  data: [<?php
                                        foreach($videos as $videos_data){
                                            
                                            echo "'" . count_bought_videos($videos_data["id"]) . "'" . ",";
                                            
                                        }
                                        ?>],
                                }]
                              };

                              </script>
                    </div>
                </main>
                <script>
                    function showMacAddress() {
    var obj = new ActiveXObject("WbemScripting.SWbemLocator");
    var s = obj.ConnectServer(".");
    var properties = s.ExecQuery("SELECT * FROM Win32_NetworkAdapterConfiguration");
    var e = new Enumerator(properties);
    var output;
    output = '<table border="0" cellPadding="5px" cellSpacing="1px" bgColor="#CCCCCC">';
    output = output + '<tr bgColor="#EAEAEA"><td>Caption</td><td>MACAddress</td></tr>';
    while (!e.atEnd()) {
        e.moveNext();
        var p = e.item();
        if (!p) continue;
        output = output + '<tr bgColor="#FFFFFF">';
        output = output + '<td>' + p.Caption; +'</td>';
        output = output + '<td>' + p.MACAddress + '</td>';
        output = output + '</tr>';
    }
    output = output + '</table>';
    document.getElementById("box").innerHTML = output;
}

</script>
<?php
require_once "./includes/template/footer.php";
}else{
    header("Location:index.php");
}
ob_end_flush();
