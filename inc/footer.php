    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>

    <script>
    $(document).ready(function() {
        $('#output').hide();
        $('.runtests').on('click', function(event) {
            $(this).addClass('disabled').html('Running Tests');
            setInterval(dotdotdot, 1000);
        }); 
        var toggle_label = $('#togglecode').html();
        $('#togglecode').click(function(event) {
            if($('#togglecode').html() == toggle_label) {
                $('#togglecode').html(toggle_label.replace('Show', 'Hide'));
            } else {
                $('#togglecode').html(toggle_label);
            }
            $('#output').slideToggle();
        });
    });
    var dots = 0;
    function dotdotdot() {
        dots = dots + 1;
        if(dots > 3) {
            $("#runtests").html("Running Tests");
            dots = 0;
        } else {
            $("#runtests").html($("#runtests").html() + '.');
        }
    }
    </script>
    </body>
</html>
