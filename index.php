<!--
<object width="450" height="380"><param name="movie" value="http://www.wiqet.com/wiqet/english/mwwkytjenam/"></param><param name="wmode" value="transparent"></param><embed src="http://www.wiqet.com/wiqet/english/mwwkytjenam/" type="application/x-shockwave-flash" wmode="transparent" width="450" height="380"></embed></object>
-->
<!---start copy paste here-->

<div id="flashWiqet">Wiqet being loaded...</div>
<div id="linkWiqet"></div>
<div> <input type="text" id="html"> </div>
<form method="post">
<div id="formWiqet">Form being loaded...</div>
</form>

<script src="http://www.wiqet.com/media/splashpage/js/wiqet.js"
type="text/javascript"></script>
<script type="text/javascript">

var IVcustomerId = '873182bb3aa17d078554d4e97eb12fd2';
var IVuniqueId = 'test'; //Cannot be empty!
var IVWiqetCode = 'dqmbhxnmxkb';  
var IVplayerUrl = 'editor.swf';
var IVDisplayUrl = 'http://fedora5/wiqet/developer/wordpress/index.php';
var IVwidth = '500px';
var IVheight = '420px';
var IValign = 'middle';
var IVbgColor = '#ffffff';
var IVdivForm = 'formWiqet';
var IVdivPlayer = 'flashWiqet';
var IVdivLink = 'linkWiqet';
var IVFormName = 'Wiqet';
var IVFormnameType = 'text'; //or hidden
var error = play_wiqet(IVDisplayUrl,IVplayerUrl,'editor',IVWiqetCode,IVcustomerId,IVuniqueId,IVwidth,IVheight,IValign,IVbgColor,IVdivLink,IVdivForm,IVdivPlayer,IVFormName,IVFormnameType, '', '');
if (error) document.write(error);

</script>
<script type="text/javascript">

function onWiqetSaved(){
code = document.getElementById("Wiqet[wiqetCode]").value;
url = document.getElementById("Wiqet[playerUrl]").value;
alert(code);
alert(url);
if(document.getElementById('Wiqet[wiqetCode]').value != ''){
          document.getElementById('html').value = '<object width="450" height="380"><param name="movie" value="http://www.wiqet.com/wiqet/english/'+document.getElementById('Wiqet[wiqetCode]').value+'/"></param><param name="wmode" value="transparent"></param><embed src="http://www.wiqet.com/wiqet/english/'+document.getElementById('Wiqet[wiqetCode]').value+'/" type="application/x-shockwave-flash" wmode="transparent" width="450" height="380"></embed></object>';
        }

}

</script>
<!---end copy paste here-->
<!--
<object width="450" height="380"><param name="movie" value="http://www.wiqet.com/wiqet/english/dqmbhxnmxkb/"></param><param name="wmode" value="transparent"></param><embed src="http://www.wiqet.com/wiqet/english/dqmbhxnmxkb/" type="application/x-shockwave-flash" wmode="transparent" width="450" height="380"></embed></object>
-->