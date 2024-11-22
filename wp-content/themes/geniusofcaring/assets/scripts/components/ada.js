$('select').selectric({
  disableOnMobile: false,
  onInit: function(select, selectric) {
    return;
    var uniqBaseId = select.id;
    var $input = $(selectric.elements.input);
    var $labelContainer = $(selectric.elements.label);
    var $selectricList = $(selectric.elements.items);

    // add id for current ".selectric-items" list
    $selectricList.attr({
      "id": "sl-" + uniqBaseId,
      "tab-index": "-1",
      "role": "listbox",
      "aria-expanded": "false"
    });
    $selectricList.find('li').attr({
      "role": "option"
    });

    $input.attr({
      "role": "combobox",
      "aria-owns": $selectricList.attr('id')
    });

    //$(element).closest('.selectric-wrapper').find('.selectric-input').attr('id', element[0].text);

    $labelContainer.attr({
      "aria-live": "assertive",
      "aria-atomic": "true"
    });
  }
});

$('select').on('selectric-highlight', function(event, element, selectric) {
  //debugger;
  jQuery.each(selectric.items, function(index, item) {
    // do something with `item` (or `this` is also `item` if you like)
    if (item.selected) {
      item.element.focus();
      return;
    }
  });
});

$(".selectric-input").attr('tabindex','-1').wrap("<label class='sr-only' aria-hidden='true'>Hidden Label</label>");