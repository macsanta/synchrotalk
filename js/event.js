window.EventModules = '';

event = function(text)
{
  console.log(text+'orest');
}

get_events = function(target, target_group)
{
  phoxy.ApiRequest(['event/get_events', target, target_group], function(data)
  {
    var data = data.data.get_events;
    for(m in data){
      data[m].data = jQuery.parseJSON(data[m].data);
    }
    console.log(data);
  });
}

event('Privet ');
