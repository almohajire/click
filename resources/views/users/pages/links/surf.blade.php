<html style="overflow-y: hidden;">
<head><title>Powerful Exchange System PRO</title>
    <link rel="stylesheet" href="{{ asset('surf/system/modules/surf/static/css.css') }}" type="text/css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
	<script type="text/javascript" src="{{ asset('surf/system/modules/surf/static/js.js') }}"></script>
</head>
<body style="overflow:hidden; margin:0px; height:100%;">
	<script type="text/javascript">
		var domain = 'http://127.0.0.1:8000';
		var auto_surf = 0;
		var token = '2413bf089bfb01b643be7e38b1c04298';
		var sid = '281';
		var hash = 'f30824bacaaabc2fc3aa0b6d658a56e9';
		var barsize = 1;
		var maxbarsize = 250;
		var numbercounter = 45;
		var numbercounter_n = 45;
		var adtimer = null;
		var focusFlag = 1;
		var fc_override = 0;
		var fc_skip = 1;
		var buster_listener = 1;
		var buster = 0;
		var buster_red = 'skip=281&bd';
		var surf_file = 'surf.php';
		var can_leave = false;
        var report_msg = 'Please tell us why do you want to report this page:';
		eval(function(p,a,c,k,e,r){e=function(c){return c.toString(a)};if(!''.replace(/^/,String)){while(c--)r[e(c)]=k[c]||e(c);k=[function(e){return r[e]}];e=function(){return'\\w+'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('0 6(a,b,c){7 e=8(9);1(e){$.2({3:"f",4:"g/2.h",i:{a:\'j\',k:a,4:b,l:c,m:e},n:\'o\',5:0(d){1(d.3===\'5\'){p.q.r(\'?s=\'+a)}t(d.u)}})}}',31,31,'function|if|ajax|type|url|success|report_page|var|prompt|report_msg||||||POST|system|php|data|reportPage|id|module|reason|dataType|json|window|location|replace|skip|alert|message'.split('|'),0,{}))
		window.onbeforeunload = bust;
	</script>
    <table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0">
      <tr>
        <td id="surfbar_td" align="center" height="68" valign="top">
          <div style='height:100%;'>
          <center>
            <table style="color:white;" width="100%" border="0" height="100%">
              <tr>
                <td class="logo">CLICK</td>
                <td width="470" class="nowrap" align="center" valign="center">
				                    <div id="loadingdiv"><img src="{{ asset('surf/system/modules/surf/static/img/loader.gif') }}" border="0" alt="Loading..." /></div>
                  <div id="timerdiv" style='display:none;'>
                    <center>
                    <table cellpadding="0" cellspacing="0">
                      <tr>
                        <td>
                          <div style='width:304px;'>
                          <table cellpadding="0" cellspacing="0" width="100%"><tr>
                            <td width="250" style="background:white; border:2px solid #f0f0f0;">
                              <div id="progressbar" style="background:url('{{ asset('surf/system/modules/surf/static/img/progressbar.gif') }}'); width:1px; float:left; height:22px;"></div>
                            </td>
                            <td style="background:#f0f0f0;">
                              <div style="color:black; font-size:16px; line-height:22px; font-family:arial; font-weight:bold; text-align:center;" id="numbercounterspan">45</div>
                            </td>
                          </tr></table>
                          </div>                 
                        </td>
                      </tr>
                    </table>
                    </center>
                  </div>
                  <div id="focusdiv" style='display:none;'>
                    <center>
                      <table cellpadding="0" cellspacing="0" style='color:white;' border="0"><tr>
                        <td width="40"><img src="{{ asset('surf/system/modules/surf/static/img/errormsg.png') }}"></td>
                        <td>
                          <div style="padding:10px;">
                            <b>You need to keep this window in focus.</b><br>
                            <a style="color:white;" href='javascript:void(0);'>Click <u>here</u> to continue</a>
                          </div>
                        </td>
                      </tr></table>
                    </center>
                  </div>
                  <div id="result_msg" style="position:relative; display:none">
                     <table valign="center" align="center" cellpadding="0" cellspacing="0" width="100%"><tbody><tr>
                       <td><div style="color: white; opacity: 1;" id="show_msg"><img src="{{ asset('surf/system/modules/surf/static/img/loader.gif') }}" border="0" alt="Loading..." /></div></td>
                     </tr></tbody></table>
                  </div>
								</td>
                <td id="bannertd" style="display:none;"><div class='bannerrotator bannerrotator_clickads'><iframe data-aa="1011756" src="//ad.a-ads.com/1011756?size=468x60" scrolling="no" style="width:468px; height:60px; border:0px; padding:0;overflow:hidden" allowtransparency="true"></iframe></div></td>
                <td align="right" valign="top">                  
				                  <img class="cursor" onclick="buster_listener=0; openInNewWindow('{{ $link->link}}');" src="{{ asset('surf/system/modules/surf/static/img/icon_openadtab.png') }}" align="absmiddle" width="11" height="10" title="Open website in a new tab">
				  <a href="javascript:void(0)" onclick="report_page('281','aHR0cDovL21uLXNob3AuY29tL3Bvd2VyZnVsLWV4Y2hhbmdlLXN5c3RlbS1wcm8=','surf');"><img src="{{ asset('surf/system/modules/surf/static/img/report.png') }}" alt="Report" title="Report" border="0"></a>
								</td>
              </tr>
            </table>
          </center>
          </div>
          <script>
              checkbanner();
              function checkbanner() {
                  var w = $(document).width();
                  if(w>1340) $(getObject('bannertd')).fadeIn('medium');
                  else $(getObject('bannertd')).fadeOut('medium');
              }
              $(window).resize(function() {
                  checkbanner();
              });
			  startbusterbreaker();
			  window.setTimeout(function() {showtimer();}, 0);
          </script>
        </td>
      </tr>
	  <tr><td id="skipped_td">Your coins: 69 | You will receive 9 coins! | <a href="?skip=281">Skip</a></td></tr>
      <tr style='height:100%;background:white;'>
        <td>
          <iframe id="pes_frame" src="{{ $link->link}}" frameborder="0" style="width:100%; height:100%; overflow-x:hidden;" vspace="0" hspace="0"></iframe>
          <!-- <iframe id="pes_frame" src="http://google.com" frameborder="0" style="width:100%; height:100%; overflow-x:hidden;" vspace="0" hspace="0"></iframe> -->
        </td>
      </tr>
    </table>
		<script type="text/javascript">
	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-117430954-1']);
	  _gaq.push(['_trackPageview']);

	  (function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();
	</script>
	</body>
</html>