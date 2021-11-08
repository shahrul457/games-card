<!-- ** Question A - Programming Test **/ -->

<?php
$people = 0;
$cardTypes = array('S','H','D','C');
$cards = array('A',2,3,4,5,6,7,8,9,'X','J','Q','K');

$deck = array();	
foreach ($cardTypes as $cardType) {
    foreach ($cards as $card) {
        $deck[] = $cardType . "-" . $card;
    }
}

$totalCards	= count($deck);
if(isset($_POST['people'])) 
{ 
    $people = (int)$_POST['people'];
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <style>
        * {
            box-sizing: border-box;
        }
        .App {
            max-width: 420px;
            margin: 0 auto;
        }
        p {
            text-align: left;
            font-weight: 500;
        }
        input[type=text],select, textarea {
            width: 80%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-top: 6px;
            margin-bottom: 16px;
            resize: vertical;
        }
        input[type=button] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type=submit]:hover {
            background-color: #45a049;
        }
        .container {
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 20px;
        }

        table {
            border-collapse: collapse;
            width: 90%;
        }

        th, td {
            text-align: center;
            padding: 8px;
        }

        tr:hover {background-color:#EEFCEE;}

        th {
            background-color: #4CAF50;
            color: white;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    </head>
    <body>
        <div className="App">
            <table width="100%" border="1" align="center">
              <tr>
                <td>
                  <form id="myForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                  <label>People:</label>
                  <input type="text" id="people" name="people" placeholder="Number of people" required="required"/>
                  <input id="submitBtn" type="button" value="Submit" />
                  </form>
                  <p>Total of Cards : <?php echo $totalCards; ?>
                  <br><?php echo implode(' , ', $deck); ?>
                  </p>
                </td>
              </tr>
              <?php
              $peopleCard = @floor($totalCards/$people);
              for($i=1; $i<=$people; $i++) {
                if ($people > $totalCards && $peopleCard == 0) {
                    $peopleCard = $totalCards/$totalCards;
                }
                
              ?>
              <tr>
                    <td>
                        <p>People <?php echo $i; ?>
                         
                        <?php 
                        if ($i <= $totalCards) {
                            $cards = array_rand($deck, $peopleCard);
                            echo "<br>Total card : ". $peopleCard;
                            echo "<br>Card : "; 
                        } else {
                            $cards = "";
                            echo "<br>Total card : ";
                            echo "<br>Card : No card availabled"; 
                        }
                        if (is_array($cards) && $peopleCard > 1) {
                            foreach ($cards as $key) {
                                $myCard[] = $deck[$key];
                                unset($deck[$key]);
                            }
                        } else{
                            unset($deck[$key]);
                        }
                        $displayCard = implode(' , ', $myCard); 
                        echo $displayCard;
                        unset($myCard);
                        ?>
                        </p>
                    </td>
              </tr>
              <?php
              } 
              if (isset($_POST['people']) && count($deck) > 0) {
              ?>
              <tr>
				<td>
                    <p>Total left card: <?php echo count($deck)." ( ".implode(' | ', $deck)." )"; ?></p>
				</td>
			  </tr>
              <?php } ?>
            </table>
          </div>
          <script>
                $(document).ready(function(){
                    $("#submitBtn").click(function(){
                        if($('#people').val() == ""){
                            alert("Please insert people value")
                        } else if(!$.isNumeric($('#people').val())) {
                            alert("Value must be in numeric")
                        } else {
                            $("#myForm").submit();
                        } 
                    });
                });
          </script>
    </body>
</html>
