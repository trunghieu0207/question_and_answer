export class Handler {
    countTotalNotification(url: string) {
        const request = new XMLHttpRequest();
        request.open('GET', url);
        request.responseType = 'json';
        request.onload = () => {
            console.log(url);
        }
    }
}
