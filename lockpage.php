<?php
	require("header.php");
	require('connect.php');
//lock 삭제 로직
	if(isset($_POST['delete'])){
		$id = $_POST['delete_lock_id'];  
		$query = "DELETE FROM locks WHERE lock_id={$_GET['id']}"; 
		$query2 = "DELETE FROM keys_table WHERE key_lockid={$_GET['id']}"; 
		$result = mysql_query($query);
		$result2 = mysql_query($query2);
		header('Location: ./');
	}

//key 삭제 로직
	if(isset($_POST['delete_key'])&$_POST['delete_key_level']==0){
	$id = $_POST['delete_key_id'];  
	$query1 = "DELETE FROM keys_table WHERE key_group={$id}"; 
	$result = mysql_query($query1);
	header('Location: ./lockpage.php?id='.$_GET['id']);
	}
	else{
		$id = $_POST['delete_key_id'];  
		$query2 = "DELETE FROM keys_table WHERE key_id={$id}"; 
		$result1 = mysql_query($query2);
	}
?>


<!-- 페이지 시작 -->
<article class="container box style1">
	<!-- Lock제목 소환-->
	<?php
		$query = "SELECT lock_content FROM locks WHERE lock_id={$_GET['id']}";
		$res = mysql_query($query);
		while($row= mysql_fetch_array($res))
		{
			echo "<h2><center>{$row['lock_content']}</center></h2>";
		}
	?>
	<!-- Lock 삭제버튼, 클릭시 위의 lock 삭제 로직 실행-->
	<?php
	if($_SESSION['signed_in']){
	echo"
	<form id=delete method=post action='' class='activated_align_right'>
		<input type=hidden name=delete_lock_id value='<?php print $id; ?>'/> 
		<input type=submit name=delete value=DELETE class='text_button'/>    
	</form>";
	}
	?>
	<hr class='title'>
	<!-- lock의 key 출력 -->
	<!-- key_date 값을 유닉스시간으로 선택-->
	<?php
		$query = "SELECT key_id,UNIX_TIMESTAMP(key_date),key_content,key_type,key_lockid,key_seq,key_group,key_level FROM keys_table WHERE key_lockid={$_GET['id']} order by key_group desc, key_seq ";
		$res = mysql_query($query);
		while($row= mysql_fetch_array($res))
		{
			//KEY type, name, babykey입력form출력
			//KEY_LEVEL에 따라 깊이를 제시함
			echo "
				<h4 class='level-{$row['key_level']} key'>
		  			<div class='showkeytype type{$row['key_type']}'></div>

		  			<div class='key_content'>{$row['key_content']}  </div>
		  		";
		  	$unixtime = $row['UNIX_TIMESTAMP(key_date)'];
		  	$timeprint = date("M-j", $unixtime); // 출력한 유닉스형태의 시간을 M-j 형으로 반환, 71번 줄에서 출력
		  	if($_SESSION['signed_in']){
		  		echo "
			  		<div class='info_area'>
				  		<div class='text_button info'>$timeprint</div> 

				  		<div class='halfheight info vertical_bottom'>	
				  			<input type='button' value='RE' class='show_babykey_input text_button' id='#babykeyinput_{$row['key_id']}'/>
				  			<input type='button' value='MOD' class='show_babykey_modify text_button' id='#babykeymodify_{$row['key_id']}'/>
				  			<form id='delete_key' method='post' action='' style='display:inline;'>
								<input type='hidden' name='delete_key_id' value='{$row['key_id']}'/> 
								<input type='hidden' name='delete_key_level' value='{$row['key_level']}'/> 
								<input type='submit' name='delete_key' value='X' class='text_button'/>    
							</form>
		  				</div>
	  				</div>
	  				<!-- REPLY form -->
					<form class='babykey_area' id='babykeyinput_{$row['key_id']}' action='newbabykey.php?id={$row['key_id']}' method='post'>
						<input id='babykeyinput_{$row['key_id']}' class='babykey_type_area' name='content' placeholder='Type your baby key here'>
						<ul class='no_paddings'>
							<li class='babykey_type_{$row['key_id']} twenty_per' >
								<input type='radio' name='type' value='A' id='key_type_button'><div class='showkeytype typeA'></div> 
								<input type='radio' name='type' value='B' id='key_type_button' checked><div class='showkeytype typeB'></div>
								<input type='radio' name='type' value='C' id='key_type_button'><div class='showkeytype typeC'></div> 
								<input type='hidden' name='parentkey' value='{$_row['key_id']}''>
							</li>
						</ul>
						<input class='babykey_type_area' type='hidden' name='keygroup' value='{$row['key_id']}'>
						<input type='hidden' name='lock_id' value={$_GET['id']}>
						<button id='#babykeyinput_{$row['key_id']}' class='babykeysubmit' type='submit' name='submit_babykey'>SUBMIT</button>
					</form>

					<!-- MODIFY form -->
					<form class='babykey_modify_area' id='babykeymodify_{$row['key_id']}' action='babykey_modify.php?id={$row['key_id']}' method='post'>
						<input id='babykeymodify_{$row['key_id']}' class='babykey_type_area' name='content' value='{$row['key_content']}''>
						<ul class='no_paddings'>
							<li class='babykey_type_{$row['key_id']} twenty_per' >
								<input type='radio' name='type' value='A' id='key_type_button'><div class='showkeytype typeA'></div> 
								<input type='radio' name='type' value='B' id='key_type_button' checked><div class='showkeytype typeB'></div> 
								<input type='radio' name='type' value='C' id='key_type_button'><div class='showkeytype typeC'></div> 
								<input type='hidden' name='parentkey' value='{$_row['key_id']}''>
							</li>
						</ul>

						<input class='babykey_type_area' type='hidden' name='keygroup' value='{$row['key_id']}'>
						<input type='hidden' name='lock_id' value={$_GET['id']}>
						<button id='#babykeymodify_{$row['key_id']}' class='babykeysubmit' type='Modify' name='submit_babykey'>SUBMIT</button>
					</form>	
	  			</h4>



	  			";
			}	
		}

		//key 삭제 로직


/*

조건에 추가 

		{
			$query3 = "DELETE FROM synaps.keys_table WHERE key_id={$id}"; 
			$result = mysql_query($query);
			$result2 = mysql_query($query2);
			 }
*/

	?>

	

	<!-- 새 key 입력란-->

	<?php
	if($_SESSION['signed_in']){
	echo "
	<hr>
	<div id='newkey'>
		<form action='newkey.php' method='post' class='newkeyarea'>
			<textarea name='content' class='seventy_per vertical_down' placeholder='Add your key here'></textarea>
			<div class='no_paddings thirty_per'>
				<ul>
					<li class='newkey_key_type'>
						<input type='radio' name='type' value='A' id='key_type_button'><div class='showkeytype typeA'></div> 
						<input type='radio' name='type' value='B' id='key_type_button' checked><div class='showkeytype typeB'></div> 
						<input type='radio' name='type' value='C' id='key_type_button'><div class='showkeytype typeC'></div> 
						<input type='hidden' name='lock_id' value='".$_GET['id']."'>
					</li>
				</ul>
			</div>
			<ul class='actions'>
				<li><input class='button' type='submit' id='key_submit_button' value='Submit'></li>
			</ul>
		</form>
		<div style='clear:both;'></div>
	</div>
	";
	}
	?>
	<!-- 내용 끝-->				
</article>
<?php
	require("footer.php");
?>