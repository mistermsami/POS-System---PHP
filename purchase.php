<?php
	include("include/opendb.php");
	if(isset($_POST['m_id'])){
		$discount = $_POST['discount'];
		$servedby = $_POST['servedby'];
		$promo = $_POST['promo'];
		$sql = "INSERT INTO neworder (or_discount, e_id, pr_id, or_date, or_time) VALUES (?, ?, ?, NOW(), NOW())";
		$stmt = $conn->prepare($sql);
		$stmt->execute([$discount, $servedby, $promo]);
		$pid = $conn->lastInsertId();
	
	
 
		$total=0;
		$actualcost=0;
		$gtotal=0;
		$fgtotal=0;
		$profit=0;
		$soquantity=0;
 
		foreach($_POST['m_id'] as $product):
		$proinfo=explode("||",$product);
		$m_id=$proinfo[0];
		$iterate=$proinfo[1];
		$sql="select * from menue where m_id='$m_id'";
		$query=$conn->query($sql);
		$row=$query->fetch(PDO::FETCH_ASSOC);
 
		if (isset($_POST['quantity_'.$iterate])){
			$subt=(int)$row['m_itemprice']*(int)$_POST['quantity_'.$iterate];
			$act=(int)$row['m_itemcost']*(int)$_POST['quantity_'.$iterate];
			$actualcost+=$act;
			$total+=$subt;
			$disper=$_POST['discount'];
			$disamt=round(($total/100)*(int)$disper,2);
			$gtotal=round($total-$disamt,2);

			$sql="insert into sales (or_id, m_id, sa_quantity, sa_itemtotal, sa_itemcost) values ('$pid', '$m_id', '".$_POST['quantity_'.$iterate]."', '$subt','$actualcost')";
			$conn->query($sql);

			$soquantity=$_POST['quantity_'.$iterate];
            $sqll="insert into stock (m_id, or_id, sold_quantity, s_date) values ('$m_id', '$pid', '$soquantity', NOW())";
			$conn->query($sqll);
			
		
		}
		endforeach;
		$que="select neworder.pr_id, promotions.pr_rupees from neworder inner join promotions on promotions.pr_id= neworder.pr_id where neworder.or_id='$pid'";
                $result= $conn->query($que) or die("Query Error");
                foreach ($result as $row) {
                	$fgtotal=$gtotal- $row['pr_rupees'];
                	if ($actualcost != 0) {
                		$profit= $fgtotal - $actualcost;
                	}
                	else{
                	$profit= $actualcost;
                }

                }
                $q="select count(or_id) as invoiceno from neworder where or_date like'". date("Y-m-d") ."%'";
                $r= $conn->query($q) or die("Query Error");
                foreach ($r as $row) {
                	$invoiceno=$row['invoiceno'];

                }
 		
 		$sql="update neworder set or_total='$total', or_grandtotal='$fgtotal', or_profit='$profit', invoiceno='$invoiceno', or_disamt='$disamt' where or_id='$pid'";
 		$conn->query($sql);
		header('location:lastinvoiceprint.php?id="'.$pid.'"');		
	}
	else{
		?>
		<script>
			window.alert('Please select a product');
			window.location.href='createinvoice1.php';
		</script>
		<?php
	}
?>