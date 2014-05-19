//NAV bar active code
$(function() {
    var pgurl = window.location.href.substr(window.location.href
    .lastIndexOf("/")+1);
    $("#nav li a").each(function(){
    if($(this).attr("href") == pgurl || $(this).attr("href") == '' )
    $(this).addClass("active");
    })
});


// Login Form

$(function() {
    var button = $('#loginButton');
    var box = $('#loginBox');
    var form = $('#loginForm');
    button.removeAttr('href');
    button.mouseup(function(login) {
        box.toggle();
        button.toggleClass('active');
    });
    form.mouseup(function() { 
        return false;
    });
    $(this).mouseup(function(login) {
        if(!($(login.target).parent('#loginButton').length > 0)) {
            button.removeClass('active');
            box.hide();
        }
    });
});


//답키 달기 애니메이션
$(window).load(function(){
$('.babykey_area').hide();
$('.babykey_modify_area').hide();

$('.show_babykey_input').click(function(e){
    var id2 = $(this).attr('id').slice(1);
    var id3 = $(this).attr('id').slice(13);
	//alert('ID is: '+ id2);
    $("#"+id2).toggle(200);//or just show instead of toggle
    $("#babykeymodify"+id3).hide(200);// hide modify form

});

$('.show_babykey_modify').click(function(e){
    var id4 = $(this).attr('id').slice(1);
    var id5 = $(this).attr('id').slice(14);
    //alert('ID is: '+ id2);
    $("#"+id4).toggle(200);//or just show instead of toggle
    $("#babykeyinput"+id5).hide(200); // hide input form
});

 
});



//답키 작성시 키 타입을 고르지 않고나 내용이 없을 경우 alert
//bla bla
/*

$(document).on('submit', 'form.babykey_area', function () {

	var id0 = $(this).attr('id').slice(1);


    var validate = true;
    var unanswered = new Array();
    var msg1=msg2= "";
    // Loop through available sets
    $('#babykey_type_'+id0).each(function () {
        // Question text
        var question = $(this).prev().text();
        // Validate
        if (!$(this).find('input').is(':checked')) {
            unanswered.push(question);
            validate = false;
        }
    });

    var key_content = $('input.babykeyinput_{$row['key_id']}').val(); 


	if (key_content=="") {
	    // textarea is empty or contains only white-space
	    msg1 = "Textarea is empty."; 
	    validate = false;
	    alert(msg1);
	}
	if (unanswered.length > 0) {
        msg2 = "Please select the type of the key."; 
        validate = false;
        alert(msg2);
    }
    return validate;
});
*/


//Lock 빈칸입력 submit견제
$(document).on('submit', 'form.newlock', function () {

    var validate0 = true; 
    var lock_content = $('textarea[name="lock"]:visible').val(); 
    	if (lock_content=="") {
	    // textarea is empty or contains only white-space
	    validate0 = false;
	    alert("Textarea is empty");
	   }
    return validate0;
});





//NEWKEY 작성시 키 타입을 고르지 않거나 내용이 없을 경 alert

// Delegate submit action
$(document).on('submit', 'form.newkeyarea', function () {

    var validate = true;
    var unanswered = new Array();
    var msg1=msg2= "";
    // Loop through available sets
    $('.newkey_key_type').each(function () {
        // Question text
        var question = $(this).prev().text();
        // Validate
        if (!$(this).find('input').is(':checked')) {
            unanswered.push(question);
            validate = false;
        }
    });

    var key_content = $('textarea[name="content"]:visible').val(); 


	if (key_content=="") {
	    // textarea is empty or contains only white-space
	    msg1 = "Textarea is empty."; 
	    validate = false;
	    alert(msg1);
	}
	if (unanswered.length > 0) {
        msg2 = "Please select the type of the key."; 
        validate = false;
        alert(msg2);
    }
    return validate;
});

//배경이미지 변경 함수
$(function() {

    $('#background_1').click(function() {
        $('body').css('background-image', 'url(./images/bg1.jpg)');
    });
    $('#background_2').click(function() {


        $('body').css('background-image', 'url(./images/bg2.jpg)');


        
    });
    $('#background_3').click(function() {
        $('body').css('background-image', 'url(./images/bg3.jpg)');
    });

});

