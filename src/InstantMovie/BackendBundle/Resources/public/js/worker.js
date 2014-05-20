
worker.postMessage("hola mundo");

worker.onmessage = function (evt) {
        alert(evt.data);
}

