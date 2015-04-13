var message="Welcome to NTU Fitness Factory!";
   message += " Are you ready to exercise? ";
   var space="...";
   var position=0;
   function scroller(){
        var newtext = message.substring(position,message.length)+
        space + message.substring(0,position);
        var td = document.getElementById("tabledata");
        td.firstChild.nodeValue = newtext;
        position++;
        if (position > message.length){position=0;}
        window.setTimeout("scroller()",200);
   }