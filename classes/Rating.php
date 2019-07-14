<?php 
require_once "Database.php";

class Rating {
	private $Car_ID;
	private $User_ID;
    private $Rating;
	
	function Rating($car_id, $user_id, $rating){
		$this->Car_ID = $car_id;
		$this->User_ID = $user_id;
		$this->Rating = $rating;
	}
	
    public function Create(){
		$database = Database::Get_Instance();
		$connection = $database->Get_Connection();
		
		try{
		$query = "INSERT INTO ratings (Car_ID, User_ID, Rating)";
		$query .= " VALUES(?,?,?)";
		$stmt = $connection->prepare($query);
		$stmt->bindParam(1,$this->Car_ID);
        $stmt->bindParam(2,$this->User_ID);
		$stmt->bindParam(3,$this->Rating);
       	        
		$stmt->execute();
		}	
		catch(PDOException $e){echo "Error: " . $e->getMessage();
		}		
	}

	public static function Display_Form($Rating){ 
		if (empty($Rating)){ 
			echo '<font color = #CC0000><h6>Please rate:</h6></font>';
		}else{ 
			echo '<font color = #CC0000><h6>Your rating is:</h6></font>';
		}
		echo '<form action="#" method="Post">';
        echo '<fieldset class="rating"';
        if (!empty($Rating)) 
			echo "disabled='disabled'"; 
		echo '>';
        echo '<input type="radio" id="star5" name="rating" value="5" ';
		if ($Rating ==5 ) echo "checked='checked'"; 
		echo 'onchange="this.form.submit();" /><label for="star5" title="Excellent">5 stars</label>';
		
        echo '<input type="radio" id="star4" name="rating" value="4"';
		if ($Rating == 4) echo "checked='checked'"; 
		echo 'onchange="this.form.submit();" /><label for="star4" title="Good">4 stars</label>';
                            
		echo '<input type="radio" id="star3" name="rating" value="3" ';
		if ($Rating == 3) echo "checked='checked'";
		echo 'onchange="this.form.submit();" /><label for="star3" title="Not Bad">3 stars</label>';
                            
		echo '<input type="radio" id="star2" name="rating" value="2"';
		if ($Rating == 2) echo "checked='checked'"; 
		echo 'onchange="this.form.submit();" /><label for="star2" title="Fair">2 stars</label>';
                            
		echo '<input type="radio" id="star1" name="rating" value="1" ';
		if ($Rating == 1) echo "checked='checked'"; 
		echo 'onchange="this.form.submit();" /><label for="star1" title="Poor">1 star</label>';
        echo '</fieldset> </form>';
	}

}

?>