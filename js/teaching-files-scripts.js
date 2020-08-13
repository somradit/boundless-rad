$(document).ready(function(){
    $('input:radio[name="choices1"]').change(function(){
        $("#answer1").show();
        $("#question2").show();
    });
    
    $('input:radio[name="choices2"]').change(function(){
        $("#answer2").show();
        $("#question3").show();
    });
    
  	$('input:radio[name="choices3"]').change(function(){
        $("#answer3").show();
        $("#question4").show();
    });
    	  
    $('input:radio[name="choices4"]').change(function(){
        $("#answer4").show();
        $("#question5").show();
    });
    
    $('input:radio[name="choices5"]').change(function(){
        $("#answer5").show();
    });
    	  
});

