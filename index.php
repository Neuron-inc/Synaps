<?php
	require("header.php");
	require('connect.php');
?>

<!-- Type lock -->
<article class="container box style1">

	<?php
		if($_SESSION['signed_in']){
			echo "
			<div id='newlockarea'>
				<form action='newlock.php' method='post' class='newlock'>
					<textarea class='seventy_per key-box' name='lock' placeholder='Type your lock'></textarea>
						<div class='lockpage_button'><input class='button' type='submit' value='Submit'></div>
				</form>
				<div style='clear:both;'></div>
			</div>
			<hr>
			";
		}
	?>
	<!-- 아이디어 리스트 -->
	<!-- 전형준 코드.
	<?php
		$query = "SELECT lock_id, lock_content FROM locks order by lock_id desc";
		$res = mysql_query($query);

		//res를 이용하여 $row 변수에 모든 레코드를 배열로 가져와서 while 문을 이용하여 출력
		while($row= mysql_fetch_array($res))
		{
		  echo "<a href=lockpage.php?id={$row['lock_id']}>{$row['lock_content']}</a><br>"; //아이디어 링크 추가
		}	
	?>
	-->
		<div class='key-box'>
			<?php
				$query = "SELECT lock_id, lock_content FROM locks order by lock_id desc";
				$res = mysql_query($query);
				$res1 = mysql_fetch_array($res);
				$count = count($res1);
				//res를 이용하여 $row 변수에 모든 레코드를 배열로 가져와서 while 문을 이용하여 출력
				if($count==1){
					echo "<center>There is no key left.</center>";
							   }
					else{
						 echo "&nbsp;&nbsp;<a href=lockpage.php?id={$res1['lock_id']}>{$res1['lock_content']}</a><br>"; //아이디어 링크 추가
						while($row= mysql_fetch_array($res)){
				 		 echo "&nbsp;&nbsp;<a href=lockpage.php?id={$row['lock_id']}>{$row['lock_content']}</a><br>"; //아이디어 링크 추가
							}	
						}

			?>
		</div>
	
	<center>
		<div style="display:none;"> <!--아이디어리스트 전체제거-->
			<a href=delete_all_key.php><input class="button1" type="submit" value="RESET"></a>
		</div>
	</center>

</article>


<?php
	require("footer.php");
?>