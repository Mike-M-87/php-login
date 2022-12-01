<?php require("header.php") ?>

<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require "my_functions.php";


if (isset($_POST['vote'])) {

    $president = $vicepresident = 0;
    $error = $success = "";


    $vote_positions = $_POST;
    array_pop($vote_positions);


    $user_id = $_SESSION['user_id'];

    $election_id = 1;

    $sql = "SELECT * FROM votes WHERE user_id = $user_id AND election_id = $election_id ";
    $result = mysqli_query($dbconnect, $sql);
    $row = mysqli_num_rows($result);
    if ($row > 0) {
        $error = "<div class='alert alert-danger alert-mg-b' role='alert'>You have already voted in this election.'</div>";
    } else {


        foreach ($vote_positions as $position_id => $candidate_id) {
            if (isset($position_id)) {
                $vote_positions[$position_id] = sanitize($candidate_id);
                $sql = "INSERT INTO votes (user_id, candidate_id , election_id,position_id )  VALUES ($user_id, $candidate_id  ,$election_id, $position_id)";
                if (!mysqli_query($dbconnect, $sql)) {
                    $error = "<div class='alert alert-danger alert-mg-b' role='alert'>Error voting for position $position_id </div>";
                }
            }
        }
    }
}

?>


<!-- President Section -->


<?php if (isset($success)) : echo $success;
endif; ?>
<?php if (isset($error)) : echo $error;
endif; ?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="votePresidentForm">

    <?php
    $sql = "SELECT * FROM position";
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
                                                <p>
                                                    Vote for your preferred <?php echo $positionName; ?> Candidate
                                                </p>
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
                                            <h4><?php echo $firstname . " " . $othernames . " " . $positionId; ?></h4>
                                        </a>
                                        <div class="pro-rating">
                                            <input type="radio" name="<?php echo $positionId; ?>" id="president" value="<?php echo $user_id; ?>" style="width:30px; height:30px; cursor:pointer" />
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
    ?>

    <div class="section-admin container-fluid res-mg-t-15" style="margin-top:15px;">
        <div class="row admin text-center">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="admin-content analysis-progrebar-ctn res-mg-t-30">
                            <input type="submit" class="btn btn-custon-rounded-two btn-success" name="vote" value="Click To Cast Your Vote" id="vote" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
</form>




<?php require("footer.php") ?>