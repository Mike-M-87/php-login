<?php
require("header.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);
require "my_functions.php";
?>

<?php
$sql = "SELECT * FROM election";
$result = mysqli_query($dbconnect, $sql);
$elections = mysqli_fetch_all($result, MYSQLI_ASSOC);

foreach ($elections as $election) {
    $election_id = $election['id'];
    $sql = "SELECT * FROM position WHERE election_id = $election_id";
    $result = mysqli_query($dbconnect, $sql);
    $positions = mysqli_fetch_all($result, MYSQLI_ASSOC);

    foreach ($positions as $position) {
        $positionId = $position["id"];
        $positionName = $position["name"];
?>
        <div>
            <div class="breadcome-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="breadcome-list">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <div class="breadcomb-wp">
                                            <div class="breadcomb-icon">
                                                <i class="icon nalika-new-file"></i>
                                            </div>
                                            <div class="breadcomb-ctn">
                                                <h2><?php echo $positionName; ?></h2>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <div class="breadcomb-report">
                                            <button data-toggle="tooltip" data-placement="left" title="Download Report" class="btn">
                                                <i class="icon nalika-download"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Candidates Area -->

            <div class="product-new-list-area">
                <div class="container-fluid">
                    <div class="row">

                        <?php
                        $sql = "SELECT * FROM candidate WHERE position_id = $positionId";
                        $result = mysqli_query($dbconnect, $sql);
                        $candidates = mysqli_fetch_all($result, MYSQLI_ASSOC);

                        foreach ($candidates as $cand) {
                            $user_id = $cand['id'];
                            $user_sql = "SELECT * FROM users WHERE id= $user_id";
                            $user_results = mysqli_query($dbconnect, $user_sql);
                            $user_details = mysqli_fetch_assoc($user_results);
                            $firstname = $user_details['firstname'];
                            $othernames = $user_details['othernames'];
                        ?>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="single-new-trend mg-t-30">
                                    <a href="#"><img src="../img/sabinus.jpeg" alt="ELectoral Candidate"></a>

                                    <div class="overlay-content">
                                        <br />
                                        <a>
                                            <h1><?php echo $positionName; ?></h1>
                                        </a>

                                        <a class="btn-small"><?php echo $firstname . " " . $othernames; ?></a>
                                        <br />

                                        <a>
                                            <h4><?php echo $firstname . " " . $othernames . " "; ?></h4>
                                        </a>
                                        <div class="pro-rating">
                                            <?php
                                            $sql = "SELECT * FROM votes WHERE candidate_id = $user_id";
                                            $result = mysqli_query($dbconnect, $sql);
                                            $candidates = mysqli_fetch_all($result, MYSQLI_ASSOC);
                                            echo count($candidates);
                                            ?>
                                            Votes
                                        </div>
                                    </div>



                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
<?php }
}
?>