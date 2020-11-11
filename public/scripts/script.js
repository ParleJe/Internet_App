function vh(v) {
    var h = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
    return (v * h) / 100;
  }
  
  function vw(v) {
    var w = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
    return (v * w) / 100;
  }
  
  function vmin(v) {
    return Math.min(vh(v), vw(v));
  }
  
  function vmax(v) {
    return Math.max(vh(v), vw(v));
  }

function showMenu() {

    var element = document.getElementById('navigation-bar'),
        style = window.getComputedStyle(element),
        left = style.getPropertyValue('left');
        
    if(left == "0px") {
        element.style.left = new String(vw(-70)+'px');
    }else {
        element.style.left = vw(0);
    }

}
