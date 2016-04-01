var thread = function thread(){};

window.EventModules['thread'] = thread;

thread.getEvent = function(event)
{
  var event_data = JSON.parse(event.data);
  console.log('user = '+thread.user);
  event_data['user'] = thread.user;
  //last id
  if(typeof last_id === 'undefined')
  {
    if(thread.ejs.messages[0])
      last_id = thread.ejs.messages[thread.ejs.messages.length - 1]['id'];
    else
      last_id = 0;
  }

  if(event_data.thread_id==thread.ejs.t_id)
  {
    if(event_data.messsage_id > last_id)
    {
      last_id = event_data.messsage_id;
	  console.log(event_data);
      thread.ejs.onEvent(event_data, thread.ejs.first());
    }
  }

}
