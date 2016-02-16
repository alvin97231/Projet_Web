

    var c = {};

    function allowDrop(ev) {
        ev.preventDefault();
    }

    function drag(ev, element) {

        ev.dataTransfer.effectAllowed = 'move';
        ev.dataTransfer.setData("text/html", element.innerHTML);
        console.log(element.innerHTML);
    }

    function drop(ev) {
      ev.preventDefault();
      var data = ev.dataTransfer.getData("text/html");
      console.log(data);
      ev.target.appendChild(document.getElementById(data));
        //var supplie = ui.draggable.text();

    }
