</div><br><br>
<div class="col-md-12 text-center">&copy; copyright 2013-2015 Alex's Boutique</div>

<!-- Details Modal -->


<script>
    $(window).scroll(function(){
        var vscroll = $(this).scrollTop();
        $('#logotext').css({
            "transform":"translate(0px, "+vscroll/2 + "px)"
        })
        var vscroll = $(this).scrollTop();
        $('#back-flower').css({
            "transform":"translate("+vscroll/5+"px, -"+vscroll/12 + "px)"
        })
        var vscroll = $(this).scrollTop();
        $('#fore-flower').css({
            "transform":"translate(0px, -"+vscroll/2 + "px)"
        })
    });

    function detailsmodal(id){
        var data = {"id" : id};
        $.ajax({
            url: 'includes/detailsmodal.php',
            method : "post",
            data : data,
            success: function(data){
                $('body').append(data);
                $('#details-modal').modal('toggle', {backdrop: 'static', keyboard: false});

            },
            error : function(){
                alert("something went wrong!")
            }
        });
    }

</script>
</body>
</html>