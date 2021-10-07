
var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http, {
    cors: {
        origin: "http://chat-app.test",
        methods: ["GET", "POST"]
      }
});

http.listen(8000, ()=>{
    console.log("welcome to socket.io");
})

io.on('connection', (socket) => {
console.log("user connected")
    socket.on('chat', (data) =>{
        socket.broadcast.emit('chat', data)
    })

})

io.on('disconnected', (userdata) =>{
    console.log("disconnected")
})

