<?php




include "header.php";

if($user->islg())
	{
		  $string = '<script type="text/javascript">';
    $string .= 'window.location = "/smp/message/index"';
    $string .= '</script>';

    echo $string;
}
?>
<div class=before_post>
<form action="/smp/login/google">
    <input type="submit" value="Google" />
</form>
<form action="/smp/login/facebook">
    <input type="submit" value="Facebook" />
</form>
<!--
<form action="/smp/login/vk">
    <input type="submit" value="Vk.com" />
</form>
-->
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<form action="/smp/message/index">
    <input type="submit" value="Пропустить" />
</form>

</div>
<?php
include "footer.php";

?>
