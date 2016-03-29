window.EventModules = [];

get_events = function(target_group)
{
  phoxy.ApiRequest(['event/get_events',target_group], function(r)
  {
    for(n in r.data.events){
      var event = r.data.events[n];
      var module = event.target_group;
      if(!window.EventModules[module]){
        console.log('Module '+module+' not found!');
      }else{
        window.EventModules[module].getEvent(event);
      }
    }
  });

}
