<?php

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




?>
