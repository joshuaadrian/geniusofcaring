  const containerElem = document.getElementById('marquee--block');

  if ( containerElem != null ) {

    var items = [...document.getElementsByClassName('marquee--item')];
    var leftSideOfContainer = containerElem.getBoundingClientRect().left;

    var listElem = document.getElementById('marquee--list');
    var currentLeftValue = 0;
    
    // Kick off for the animation function.
    window.setInterval(animationLoop, 50);
  }
  
  /* 
    Looks at first item in the list and checks if it goes out of the visible area 
    by comparing the right position of the first list item to the left position 
    of the containing element. 
  */
  function animationLoop() {

    var listElem = document.getElementById('marquee--list');

    const firstListItem = listElem.querySelector('.marquee--item:first-child');
    
    let rightSideOfFirstItem = firstListItem.getBoundingClientRect().right;
    
    /* 
      If first list item is out of viewable area, move it to the end of the list. 
      Also, set the current left value to -1 so we won't stutter.
    */
    if(rightSideOfFirstItem == leftSideOfContainer){
      currentLeftValue = -1;
      listElem.appendChild(firstListItem);
    }
    
    // The part that keeps it all going: animating the margin left value of the list.
    listElem.style.marginLeft = `${currentLeftValue}px`;
    currentLeftValue--;
  }