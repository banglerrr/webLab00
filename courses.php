<!DOCTYPE html>
<html>
<head>
    <title>Course list</title>
    <meta charset="utf-8" />
    <link href="courses.css" type="text/css" rel="stylesheet" />
</head>
<body>
<div id="header">
    <h1>Courses at CSE</h1>
<!-- Ex. 1: File of Courses -->
    <?php
    $lines = file("courses.tsv");
    $filesize = filesize("courses.tsv");
    ?>
    <p>
        Course list has <?= count($lines)?> total courses
        and
        size of <?= $filesize?> bytes.
    </p>
</div>
<div class="article">
    <div class="section">
        <h2>Today's Courses</h2>
<!-- Ex. 2: Today’s Courses & Ex 6: Query Parameters -->
        


        <?php
            $numberOfCourses = 3;
            function getCoursesByNumber($listOfCourses, $numberOfCourses){
                $resultArray = array();
                $temp = $listOfCourses;
                shuffle($temp);
                $resultArray = array_slice($temp,0,$numberOfCourses);
//                implement here.
                return $resultArray;
            }
            if(isset($_GET["number_of_courses"]))
                $numberOfCourses = $_GET["number_of_courses"];
            if(isset($numberOfCourses)){
                if($numberOfCourses == "")
                    $numberOfCourses = 3;
            }
            $todaysCourses = getCoursesByNumber($lines,$numberOfCourses);
        ?>

        <ol>
            <?php  
            foreach($todaysCourses as $todaysCourses1){
                $temp = explode("\t",$todaysCourses1);
                ?>
                <li><?=$temp[0]." - ".$temp[1]?></li>
            <?php
            }
            ?>
        </ol>
    </div>
    <div class="section">
        <h2>Searching Courses</h2>
<!-- Ex. 3: Searching Courses & Ex 6: Query Parameters -->

        <?php
            $startCharacter = "C";
            function getCoursesByCharacter($listOfCourses, $startCharacter){
                $resultArray = array();
                foreach($listOfCourses as $list){
                    $temp = explode("\t",$list);
                    $word = $temp[0];
                    if($word[0] == $startCharacter){
                        array_push($resultArray, $list);
                    }
                }
//                implement here.
                return $resultArray;
            }

            if(isset($_GET["character"])) {
                $startCharacter = $_GET["character"];
            }
            $searchedCourses = getCoursesByCharacter($lines, $startCharacter);
        ?>
        <p>
            Courses that started by <strong>'<?= $startCharacter ?>'</strong> are followings :
        </p>
        <ol>
            <?php
            foreach($searchedCourses as $search) {
                $temp = explode("\t",$search);
            ?>

            <li><?= $temp[0]." - ".$temp[1]?></li>

            <?php
            }
            ?>
        </ol>
    </div>
    <div class="section">
        <h2>List of Courses</h2>
<!-- Ex. 4: List of Courses & Ex 6: Query Parameters -->
        <?php
            
            function getCoursesByOrder($listOfCourses, $orderby){
                $resultArray = $listOfCourses;

//                implement here.
                return $resultArray;
            }
        ?>
        <p>
            All of courses ordered by <strong>alphabetical order</strong> are followings :
        </p>
        <ol>
            <li class="long">ARTIFICIAL INTELLIGENCE - CSE4007</li>
            <li>BIG DATA PROCESSING - CSE4036</li>
            <li class="long">COMPILER CONSTRUCTION - CSE3009</li>
            <li>COMPUTER NETWORKS - CSE3027</li>
            <li>CRYPTOGRAPHY - CSE3029</li>
            <li class="long">EMBEDDED OPERATING SYSTEMS - CSE4035</li>
            <li>MOBILE COMPUTING - CSE4045</li>
            <li class="long">SOFTWARE CONVERGENCE STRATEGY - CSE3031</li>
            <li class="long">WEB APPLICATION DEVELOPMENT - CSE3026</li>
        </ol>
    </div>
    <div class="section">
        <h2>Adding Courses</h2>
<!-- Ex. 5: Adding Courses & Ex 6: Query Parameters -->
        <p>Input course or code of the course doesn't exist.</p>
    </div>
</div>
<div id="footer">
    <a href="http://validator.w3.org/check/referer">
        <img src="http://selab.hanyang.ac.kr/courses/cse326/2015/problems/images/w3c-html.png" alt="Valid HTML5" />
    </a>
    <a href="http://jigsaw.w3.org/css-validator/check/referer">
        <img src="http://selab.hanyang.ac.kr/courses/cse326/2015/problems/images/w3c-css.png" alt="Valid CSS" />
    </a>
</div>
</body>
</html>
