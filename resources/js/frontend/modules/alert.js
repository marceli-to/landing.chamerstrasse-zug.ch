var Alert = (function() {

  /* --------------------------------------------------------------
   * OPTIONS AND VARIABLES
   * ------------------------------------------------------------ */

  // this 
  var _self;
    
    // selectors 	
  var selectors = {
    body:  'body', 
    alert: '.js-alert',
  };

  /* --------------------------------------------------------------
  * METHODS
  * ------------------------------------------------------------ */

  var _initialize = function() {
    _self = this;
    _bind();
  };

  var _bind = function() {
    if ($(selectors.body).find(selectors.alert)) {
      setTimeout(function(){
        $(selectors.alert).fadeOut('fast');
      },3000);
    }
  };

  /* --------------------------------------------------------------
  * RETURN PUBLIC METHODS
  * ------------------------------------------------------------ */
        
  return {
    init: _initialize,
  };

})();

// Initialize
Alert.init();