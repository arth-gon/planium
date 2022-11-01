$(document).ready(function(){
    
    var current_fs, next_fs, previous_fs; //fieldsets
    var opacity;

    $(".plano").blur(function(event)
    {
        var plano = $(this).val();
        if (plano.length > 0)
        {
            $.post("inc/valida-plano.php",{plano:plano},function(data)
            {
                if(isNaN(data))
                {
                    event.stopPropagation();
                    alert(data);
                    $("#idplano").val("");
                    $(".plano").val("");
                    $(".plano").focus();
                }
                else
                {
                    $("#idplano").val(data);
                }
            })
        }
    });
    
    $(".next").click(function(){
        
        current_fs = $(this).parent();
        next_fs = $(this).parent().next();

        if($("#qtd").hasClass('active'))
        {
            var qtd = $(".qtd").val();
            $.post("inc/idade.php",{qtd:qtd},function(data)
            {
                $("#idadeBeneficiarios").html(data);
                $('.idade').keypress(function(event)
                {
                let pattern = /[^0-9]/;
                if(pattern.test(String.fromCharCode(event.keyCode)))
                {
                    alert("Caracter inválido");
                    event.preventDefault();
                }
                });
            });
            $.post("inc/nome.php",{qtd:qtd},function(data)
            {
                $(".nome").html(data);
            });
        }

        //Remove Class Active
        $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
        
        //Add Class Active
        $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
        
        //show the next fieldset
        next_fs.show(); 
        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
            step: function(now) {
                // for making fielset appear animation
                opacity = 1 - now;
    
                current_fs.css({
                    'display': 'none',
                    'position': 'relative'
                });
                next_fs.css({'opacity': opacity});
            }, 
            duration: 600
        });
    });
    
    $(".previous").click(function(){
        
        current_fs = $(this).parent();
        previous_fs = $(this).parent().prev();
        
        //Remove class active
        $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

        //Add Class Active
        $("#progressbar li").eq($("fieldset").index(previous_fs)).addClass("active");
        
        //show the previous fieldset
        previous_fs.show();
    
        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
            step: function(now) {
                // for making fielset appear animation
                opacity = 1 - now;
    
                current_fs.css({
                    'display': 'none',
                    'position': 'relative'
                });
                previous_fs.css({'opacity': opacity});
            }, 
            duration: 600
        });
    });
        
    $(".submit").click(function(){
        $("#msform").submit();
    })
        
    });