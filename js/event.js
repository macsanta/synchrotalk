window.EventModules = [];

var wsUri = "ws://localhost:3000";
websocket = new WebSocket(wsUri);

websocket.onopen = function(ev) {
	console.log(ev);
  phoxy.ApiRequest(['user/GetUserName',{}], function(r)
  {
    var user_data = {'type':'login', 'username':r.data.GetUserName};
    websocket.send(JSON.stringify(user_data));
  });
}

websocket.onmessage = function(ev) {
	console.log(ev);
  var events = JSON.parse(ev.data);
  if(events.type=="event")
  {
    var data = events.data;
    for(n in data)
    {
      console.log(data[n]);
    }
  }

}
