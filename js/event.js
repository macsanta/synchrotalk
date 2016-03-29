window.EventModules;

get_events = function(target_group)
{
  phoxy.ApiRequest(['event/get_events',target_group], function(data)
  {
    console.log(data);
  });
}
