 (function() {
        var isIE = !!window.MSInputMethodContext && !!document.documentMode;
        if (isIE) {
        // Create Promise polyfill script tag
            var promiseScript = document.createElement("script");
            promiseScript.type = "text/javascript";
            promiseScript.src =
                "https://cdn.jsdelivr.net/npm/promise-polyfill@8.1.3/dist/polyfill.min.js";

        // Create Fetch polyfill script tag
            var fetchScript = document.createElement("script");
            fetchScript.type = "text/javascript";
            fetchScript.src =
                "https://cdn.jsdelivr.net/npm/whatwg-fetch@3.4.0/dist/fetch.umd.min.js";

        // Add polyfills to head element
            document.head.appendChild(promiseScript);
            document.head.appendChild(fetchScript);
        }
    function convertToObject(str) {
	    str = str.split('; ');
	    const result = {};
	    for (let i = 0; i < str.length; i++) {
		    const cur = str[i].split('=');
		    result[cur[0]] = cur[1];
	    }
	    return result;
    }
    function getCookie(cookieId){
        try {
            const cookies = convertToObject(document.cookie);
            if (cookies[cookieId]) {
                return cookies[cookieId];
            }
            return null;
	    } catch (error) {
		    return null;
	    }
    }
    function generateUUID() {
        const timestamp = new Date().getTime().toString(16);
        const randomString =
            Math.random().toString(36).substring(2, 10) +
            Math.random().toString(36).substring(2, 10) +
            Math.random().toString(36).substring(2, 10) +
            Math.random().toString(36).substring(2, 6);
        return (timestamp + randomString).slice(0, 32);
    }
    function invokeScriptExecution() {
        var checkAttribute = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : false;
        var additionalSessionData = arguments.length > 0 && arguments[1] !== undefined ? arguments[1] : null;
        var value = null;
        var height = "100%";
        var width = "100%";
        var expectedValue = "true";
        var chatbotData = "";
        var sessionData = "";
        var embedMetaData = "";
        var hideBotOnLoad = null;
        var shouldExecuteIntially = "true";
        var meta = document.createElement('meta');
        meta.setAttribute('http-equiv', 'Content-Security-Policy');
        meta.setAttribute('content', 'upgrade-insecure-requests');
        document.getElementsByTagName('head')[0].appendChild(meta);
        script_index = 0;
        for (; script_index < document.getElementsByTagName("script").length; script_index++) {
            try{
                if (-1 !== document.getElementsByTagName("script")[script_index].getAttribute("src").indexOf("5wk5pXBWyjb9062033093867xsxzI09N")) {
                    if (document.getElementsByTagName("script")[script_index].getAttribute("data-chatbot")) {
                        try {
                            chatbotData = JSON.parse(document.getElementsByTagName("script")[script_index].getAttribute("data-chatbot"));
                        } catch (e) {
                            console.log("error in chatbot data");
                        }
                    }
                    if ((document.getElementsByTagName("script")[script_index].getAttribute("initOnPageLoad") || document.getElementsByTagName("script")[script_index].getAttribute("data-initOnPageLoad")) && checkAttribute) {
                        shouldExecuteIntially = document.getElementsByTagName("script")[script_index].getAttribute("initOnPageLoad") || document.getElementsByTagName("script")[script_index].getAttribute("data-initOnPageLoad");
                    }
                    if (document.getElementsByTagName("script")[script_index].getAttribute("data-session-payload") || additionalSessionData) {
                        try {
                            sessionData = JSON.parse(document.getElementsByTagName("script")[script_index].getAttribute("data-session-payload"));
                            objs = [sessionData, additionalSessionData],
                            sessionData =  objs.reduce(function (r, o) {
                                            Object.keys(o).forEach(function (k) {
                                                r[k] = o[k];
                                            });
                                            return r;
                                        }, {});
                        } catch (e) {
                            console.log("error in session data");
                        }
                    }
                    if (document.getElementsByTagName("script")[script_index].getAttribute("data-embed-metadata")) {
                        try {
                            embedMetaData = JSON.parse(document.getElementsByTagName("script")[script_index].getAttribute("data-embed-metadata"));
                        } catch (e) {
                            console.log("error in embed meta data");
                        }
                    }
                    value = document.getElementsByTagName("script")[script_index].getAttribute("widget-container-id");
                    hideBotOnLoad = document.getElementsByTagName("script")[script_index].getAttribute("hideBotOnLoad");
                    if (document.getElementsByTagName("script")[script_index].getAttribute("widget-height")) {
                        height = document.getElementsByTagName("script")[script_index].getAttribute("widget-height");
                    }
                    if (document.getElementsByTagName("script")[script_index].getAttribute("widget-width")) {
                        width = document.getElementsByTagName("script")[script_index].getAttribute("widget-width");
                    }
                    if ("true" != (expectedValue = document.getElementsByTagName("script")[script_index].getAttribute("widget-header-visible")) && "false" != expectedValue) {
                        expectedValue = "true";
                    }
                    break;
                }
            } catch (e){
            }
        }
        if (shouldExecuteIntially === "true") {
            window.wn.hasInitialized = true;
            let visitorUniqueId = "";
			let cookieDuration = '';
            let fileSrc = `https://objectstorage.me-abudhabi-1.oraclecloud.com/n/axh6vrlxk8jb/b/swiftsell-assets/o/modern-chat-bubble/6e50346/${`Swiftsell`.toLowerCase().replace(/ /g, '_')}-main.js`;
            visitorUniqueId = getCookie("cuid_" + "5wk5pXBWyjb9062033093867xsxzI09N") || getCookie("cuid#" + "5wk5pXBWyjb9062033093867xsxzI09N");
            if (visitorUniqueId) {
				[visitorUniqueId, cookieDuration] = visitorUniqueId.split('.');
			} else {
				visitorUniqueId = generateUUID();
			}
            var timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
            fetch("".concat("https://app.swiftsell.biz", "/v2/bot-preference?id=").concat(("5wk5pXBWyjb9062033093867xsxzI09N" || ""), "&is_source_web_preview=0&timezone=").concat(timezone, "&visitor_key=").concat(visitorUniqueId, "&web_url=").concat(encodeURIComponent(sessionData?.web_url ? sessionData?.web_url : embedMetaData ? window.document.referrer || window.location.href : window.location.href), "&browser_language=").concat(navigator.language || navigator.userLanguage, "&referrer_url=").concat(embedMetaData ? window.document.referrer : window.parent.document.referrer || '', "&script_source=").concat(("https://objectstorage.me-abudhabi-1.oraclecloud.com/n/axh6vrlxk8jb/b/swiftsell-assets/o/modern-chat-bubble/6e50346" || "").split('/').slice(-1)[0] || null).concat((embedMetaData && embedMetaData.bot_publish_key) ? "&bot_publish_key=" + embedMetaData.bot_publish_key : ""), {
                credentials: 'include'
            }).then(function(res) {
                return res.json().then(function(data) {
                    data.visitorUniqueId = visitorUniqueId;
                    data.cookieDuration = cookieDuration;
                    if (data.is_active) {
                        var main_div = document.createElement("div");
                        main_div.classList.add("chat-widget-details");
                        main_div.innerHTML = ' <input type="hidden" value="5wk5pXBWyjb9062033093867xsxzI09N" class="secret-key" /> <input type="hidden" id="bucket-conversation-attachment" value="swiftsell-conversation-attachment"/> <input type="hidden" value="" id="preference-response" /> <input type="hidden" id="wn-referral-url" value=""/>  <div id="chat-bot"></div>  <div id="modal-root" style="height: 100%;width: 100%;border: none;background-color: #000; display: none;position: fixed;top: 0px;z-index: 2147483647;"> </div><iframe id="overlay-iframe" style="height: 100%; width: 100%; border: none; background-color: rgba(0, 0, 0, 0.8); display: none; visibility: hidden; position: fixed; top: 0px; z-index: 2147483647;"> </iframe>';
                        var vendors_main = document.createElement("script");
                        var main = document.createElement("script");
                        vendors_main.src = "https://objectstorage.me-abudhabi-1.oraclecloud.com/n/axh6vrlxk8jb/b/swiftsell-assets/o/modern-chat-bubble/6e50346/vendors~main.js";
                        main.src = fileSrc;
                        main.id = "modern-chat-main-url";
                        document.body.appendChild(main_div);
                        document.getElementById('preference-response').value = JSON.stringify(data);
                        document.body.appendChild(vendors_main);
                        document.body.appendChild(main);
                        document.getElementById("wn-referral-url").value = embedMetaData ? window.document.referrer : window.parent.document.referrer;
                        window.addEventListener("message", function(textFile) {
                            if (textFile.data && function(pStringValue) {
                                    try {
                                        JSON.parse(pStringValue);
                                    } catch (e) {
                                        return false;
                                    }
                                    return true;
                                }(textFile.data)) {
                                var options = JSON.parse(textFile.data);
                                if ("autoOpenChatWindow" == options.type) {
                                    window.wn.open();
                                }
                                if (options.type && "bubble-loaded" === options.type) {
                                    if (sessionData) {
                                        window.postMessage(JSON.stringify({
                                            type: "parameterReceived",
                                            data: sessionData
                                        }), "*");
                                    }
                                    if (embedMetaData) {
                                        window.postMessage(JSON.stringify({
                                            type: "embedMetadataReceived",
                                            data: embedMetaData
                                        }), "*");
                                    }
                                    if (value) {
                                        window.postMessage(JSON.stringify({
                                            type: "wot_parent_element",
                                            header_visible: expectedValue,
                                            height: height,
                                            width: width,
                                            parentID: value
                                        }), "*");
                                    }
                                    if(hideBotOnLoad){
                                        window.postMessage(JSON.stringify({
                                            type: "hideBotOnLoad",
                                            data: hideBotOnLoad
                                        }), "*");
                                    }
                                }
                                if (options.type && "custom_script" === options.type) {
                                    if (options.message) {
                                        var scriptsPayload = JSON.parse(options.message);
                                        for (var i = 0; i < scriptsPayload.length; i++) {
                                            var script = document.createElement("script");
                                            script.type = "text/javascript";
                                            script.text = scriptsPayload[i]["script"];
                                            if (scriptsPayload[i]["target"] === "parent") {
                                                document.body.append(script);
                                            }
                                        }
                                    }
                                }
                            }
                        }, false);
                    }
                    else{
                        return "";
                    }
                });
            });
        }
    }
    window.wn = {
        initChatWidget: invokeScriptExecution
    };
    try {
        var event = new CustomEvent('WTNT-intialization', {
            detail: window.wn.hasInitialized
        });
        window.dispatchEvent(event);
    } catch (error) {
        console.log(error);
    }
})();
if ((document.readyState === 'complete' || document.readyState === 'interactive') && !window.wn.hasInitialized) {
    window.wn.initChatWidget(true);
}
window.addEventListener("load", function() {
    if (!window.wn.hasInitialized) window.wn.initChatWidget(true);
});
