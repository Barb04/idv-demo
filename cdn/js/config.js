


window.io_global_object_name = 'IGLOO';
window.IGLOO = window.IGLOO || {
  "install_flash": false,
  "bbout_element_id": 'ioBlackBox',
  "loader": {
    "uri_hook" : "/iojs/",
    "version": '5.2.2',
    "trace_handler": (msg) => {console.error(`iovation called an error ${msg}`);},
  },
};

function getBB(){
   var bb = "";
   try {
     bb = window.IGLOO.getBlackbox();
     return( bb );
   } catch (e) {
     return(e);
   }
 }
