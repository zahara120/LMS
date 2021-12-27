
<div class="example-base">
  Limited Time Only!
  <span id="clock"></span>
</div>

<script type="text/javascript">
    $('#clock').countdown('2020/10/10', function(event) {
        $(this).html(event.strftime('%D days %H:%M:%S'));
    });
</script>