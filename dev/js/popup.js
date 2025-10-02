document.addEventListener("DOMContentLoaded", () => {
    chrome.extension.sendMessage({action: "ping"}, function(resp) {
        console.log(JSON.stringify(resp));
    });
});