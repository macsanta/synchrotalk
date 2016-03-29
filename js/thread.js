var thread = function thread(){};

thread.getEvent = function(event)
{
  var event_data = JSON.parse(event.data);
  if(event_data.thread_id==thread.ejsThread.t_id){
    thread.ejsThread.onEvent(event_data, thread.ejsThread.first());
  }else{
    console.log('Thread is not openned!');
  }
}

window.EventModules['thread'] = thread;
