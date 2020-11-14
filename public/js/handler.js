var Handler = /** @class */ (function () {
    function Handler() {
    }
    Handler.prototype.countTotalNotification = function (url) {
        var request = new XMLHttpRequest();
        request.open('GET', url);
        request.responseType = 'json';
        request.onload = function () {
            console.log(url);
        };
    };
    return Handler;
}());
export { Handler };
