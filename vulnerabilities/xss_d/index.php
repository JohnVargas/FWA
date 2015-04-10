<?php

define( 'DVWA_WEB_PAGE_TO_ROOT', '../../' );
require_once DVWA_WEB_PAGE_TO_ROOT.'dvwa/includes/dvwaPage.inc.php';

dvwaPageStartup( array( 'authenticated', 'phpids' ) );

$page = dvwaPageNewGrab();
$page[ 'title' ] .= $page[ 'title_separator' ].'Vulnerability: DOM Coss Site Scripting (XSS)';
$page[ 'page_id' ] = 'xss_d';

dvwaDatabaseConnect();

$vulnerabilityFile = '';
switch( $_COOKIE[ 'security' ] ) {
	case 'low':
		$vulnerabilityFile = 'low.php';
		break;

	case 'medium':
		$vulnerabilityFile = 'medium.php';
		break;

	case 'high':
	default:
		$vulnerabilityFile = 'high.php';
		break;
}

require_once DVWA_WEB_PAGE_TO_ROOT."vulnerabilities/xss_s/source/{$vulnerabilityFile}";

$page[ 'help_button' ] = 'xss_d';
$page[ 'source_button' ] = 'xss_d';

$page[ 'body' ] .= "
<div class=\"body_padded\">
<h1>Vulnerability: DOM Cross Site Scripting (XSS)</h1>

<div class=\"vulnerable_code_area\">

<script type=\"text/javascript\">
                        function timedMsg(callback)
                        {
                        if(callback){
                                var t=setTimeout(eval('callback'),500);
                                return 0;
                        }
                        }
                        function fire()
                        {
                                        var call = location.hash.split(\"#\")[1];
                                        timedMsg(call);
                        }
</script>

<body onload=\"fire()\">


                <h2>Example Exploit: dom-xss-02.html#alert(1)</h2>

		<form method=\"post\" name=\"DOM1\" onsubmit=\"return fire(date)\">

                <!--form-->


                        <input type=\"button\" value=\"Display timed alertbox!\" onclick=\"fire()\" />


                </form>


		{$html}

	</div>

	<h2>More info</h2>

	<ul>
		<li>".dvwaExternalLinkUrlGet( 'http://ha.ckers.org/xss.html')."</li>
		<li>".dvwaExternalLinkUrlGet( 'http://en.wikipedia.org/wiki/Cross-site_scripting')."</li>
		<li>".dvwaExternalLinkUrlGet( 'http://www.cgisecurity.com/xss-faq.html')."</li>
	</ul>
</div>
";
dvwaHtmlEcho( $page );
?>
