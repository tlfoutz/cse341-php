const http = require('http');
const fs = require('fs');

function onRequest(req, res) {
    if (req.url == "/home") {
        res.writeHead(200, {"Content-Type": "text/html"});
        res.write("<h1>Hello World!</h1>");
        res.end();
    }
    else if (req.url == "/getData") {
        res.writeHead(200, {"Content-Type": "application/json"});
        var json = JSON.stringify({"name":"Travis Foutz", "class":"cse341"});
        res.write(json);
        res.end();
    }
    else if (req.url == "/homepage") {
        // takes it to another webpage
        res.writeHead(301, {Location: 'https://cryptic-thicket-00186.herokuapp.com/homepage.php'});
        res.end();
    }
    // streams a mp4 video
    // else if (req.url == "/streamVideo") {
    //     res.writeHead(200, {'Content-Type': 'video/mp4'});
    //     let vidstream = fs.createReadStream('filename.mp4');
    //     vidstream.pipe(res);
    // }
    else {
        res.writeHead(404, {"Content-Type": "text/html"});
        res.write("<h1>Page not found</h1>");
        res.end();
    }
}

var server = http.createServer(onRequest);
server.listen(2468);