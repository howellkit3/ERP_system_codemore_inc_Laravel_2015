// ==UserScript==
// @name        KeepVid Helper
// @namespace   http://keepvid.com/
// @version     0.2
// @description This userscript assists KeepVid in fetching download links. Mainly used as an alternative to the Java option currently provided.
// @copyright   2014+, KeepVid
// @icon        http://keepvid.com/userscript/icon128.png
// @icon64      http://keepvid.com/userscript/icon64.png
// @homepage    http://keepvid.com/extensions
// @updateURL   http://keepvid.com/userscript/keepvid-helper.meta.js
// @downloadURL http://keepvid.com/userscript/keepvid-helper.user.js
// @match       http://*.keepvid.com/*
// @run-at      document-start
// @grant       GM_xmlhttpRequest
// ==/UserScript==

function kvh_ap(obj){
	//Create the XMLHttpRequest, cross-browser
    
    //Build object for GM_xmlhttpRequest()
    var gm_xhr = new Object();
    gm_xhr.url = obj.params.u;
    
    //Set method
    (obj.method!=undefined) ? gm_xhr.method=obj.method : gm_xhr.method="GET";
    if(obj.params.locationonly=="yes") gm_xhr.method="HEAD";
    
    //Set request headers
    gm_xhr.headers = new Object();
    if(obj.params.ua!=undefined) gm_xhr.headers["User-Agent"]=obj.params.ua;
    if(obj.params.postdata!=undefined) gm_xhr.headers["Content-Type"]="application/x-www-form-urlencoded";
    if(obj.params.referer!=undefined) gm_xhr.headers["Referer"]=obj.params.referer;
    
    //Set the Request body with postdata if it exists
    if(obj.params.postdata!=undefined) gm_xhr.data = obj.params.postdata;
    
    //Set kvh_data textarea with the response when done
    if(obj.params.locationonly=="yes"){
        gm_xhr.onload = function(response) {
            var loc="";
            try{
               	loc = response.finalUrl;
            	if(loc=="") loc=response.responseHeaders.match(/Location: ([^\r\n]+)/i)[1];
            }catch(ex){
                
            }
            document.getElementById("kvh_data").innerHTML=loc;
        }
    }else{
        gm_xhr.onload = function(response) {
            document.getElementById("kvh_data").innerHTML=response.responseText;
        }
    }
    //Finally run GM_xmlhttpRequest()
    GM_xmlhttpRequest(gm_xhr);
}
if(!document.location.href.match(/&mode=mp3/i)){
    //Inject a variable telling the site that this Userscript is running
    var el = document.createElement('script');
    el.innerHTML='var kvh_ext = true;';
    var head = document.head || document.getElementsByTagName('head')[0];
    head.insertBefore(el, head.lastChild);
	
    //Listen on the kvh_obj textarea for a new request to make
	setInterval(function(){
		try{
			if(document.getElementById("kvh_obj").innerHTML.toString()!="~kv"){ //Check if the textarea contains a new request made by js on the site
				//Define and clean up kvh_obj
				var kvh_obj = document.getElementById("kvh_obj").innerHTML;
				kvh_obj = kvh_obj.replace(/&lt;/g,"<").replace(/&gt;/g,">").replace(/&amp;/g,"&");

				//Parse the JSON paramters (all relevent to the cross-domain request to be made)
				//Execute the request
				kvh_ap(JSON.parse(kvh_obj));
				
				//Empty the textarea to make it re-useable
				document.getElementById("kvh_obj").innerHTML="~kv";
			}
		}catch(ex){
			
		}
	},1);
}